#include <iostream>
#include <stdlib.h>
#include <string.h>

#include <microhttpd.h>
#include <config4cpp/Configuration.h>

#include "include/WebModelUnified.h"
#include "include/DbController.h"
#include "main.h"

using namespace std;

#if defined(WIN32) || defined(_WIN32) || defined(__WIN32) && !defined(__CYGWIN__)
    static const bool isWindows  = true;
#else
    #include <sys/types.h>
    #include <unistd.h>
    static const bool isWindows  = false;
#endif

const char * configFile;

int answer_to_connection (void *cls, struct MHD_Connection *connection,
                          const char *url,
                          const char *method, const char *version,
                          const char *upload_data,
                          size_t *upload_data_size, void **con_cls)
{
    const char *errorpage  = "<html><body>Supinfo IN Search - Error</body></html>";
    struct MHD_Response *response;
    int ret;
    const char* responseBody;
    unsigned int responseHttpStatus = MHD_HTTP_OK;

    //Manage request and response
    string urlStr = string(url);
    WebModelUnified* webModel = new WebModelUnified(configFile);

    if(urlStr == "/api/website/search")
    {
        const char* req = MHD_lookup_connection_value(connection, MHD_GET_ARGUMENT_KIND, "req");
        responseBody = webModel->website_search(req);
    }
    else
    {
        responseHttpStatus = MHD_HTTP_BAD_REQUEST;
        responseBody = errorpage;
    }

    //Resposne sender
    response = MHD_create_response_from_buffer (strlen (responseBody),
               (void*) responseBody, MHD_RESPMEM_PERSISTENT);
    ret = MHD_queue_response (connection, responseHttpStatus, response);
    MHD_destroy_response (response);

    return ret;
}

int main(int argc, char ** argv)
{
    bool runInBackground = false;
    configFile = "server.conf";

    for(int i = 0; i < argc; i++)
    {
        string argStr = string(argv[i]);
        if(argStr == "-c" || argStr == "-config-file")
        {
            if(i == argc -1)
            {
                cout << "Bad configuration file ! Use -c [path_to_file]" << endl;
                return 10;
            }
            else
            {
                configFile = argv[i+1];
            }
        }

        if(argStr == "-hide"){
            if(isWindows){
                cout << "Not supported on Windows" << endl;
            } else {
                runInBackground = true;
            }
        }
    }

    //parsing configuration file
    config4cpp::Configuration *  cfg = config4cpp::Configuration::create();
    const char * scope = "";
    int port;

    try
    {
        cfg->parse(configFile);
        port = cfg->lookupInt(scope, "port");
    }
    catch(const config4cpp::ConfigurationException & ex)
    {
        cerr << ex.c_str() << endl;
        cfg->destroy();
        return 1;
    }

    //starting server
    struct MHD_Daemon *mhdaemon;

    mhdaemon = MHD_start_daemon(MHD_USE_SELECT_INTERNALLY, port, NULL, NULL,
                              &answer_to_connection, NULL, MHD_OPTION_END);

    if (NULL == mhdaemon)
    {
        cout << "Error while starting SupSearch server !" << endl;
        return 20;
    }

    if(runInBackground == true){
        daemon(0,0);
    }

    cout << "Started Supinfo IN Search server on port " << port << " :)" << endl << endl;

    bool finished = false;
    do{
        cout << "1 : Add a site" << endl;
        cout << "0 : Exit" << endl;
        cout << endl << "Your choice : ";
        int choice;
		cin.clear();
        cin >> choice;
        switch(choice){
        case 0:
            finished = true;
            break;
        case 1:
            AddSite();
            break;
        }
        cout << endl << endl;
    } while (!finished);

    MHD_stop_daemon (mhdaemon);
    return 0;
}

void AddSite()
{
    cout << endl << "Add a site" << endl ;
    cout << "Url : ";
    string url;
    cin >> url;
    cout << "Title : ";;
    string title;
    cin.ignore();
    getline(cin, title);
    cout << "Description : ";
    string description;
    getline(cin, description);

	cout << endl << "Adding site : "<< title << endl;

    DbController* dbController = new DbController(configFile);
    dbController->addSite(url.c_str(), title.c_str(), description.c_str());
}
