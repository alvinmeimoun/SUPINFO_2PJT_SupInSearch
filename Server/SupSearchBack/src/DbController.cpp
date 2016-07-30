#include "../include/DbController.h"

DbController::DbController(const char* configFilePath)
{
    configFile = configFilePath;

    config4cpp::Configuration *  cfg = config4cpp::Configuration::create();
    const char * scope = "";

    try
    {
        cfg->parse(configFile);
        mysql_database = cfg->lookupString(scope, "mysql_database");
        mysql_host = cfg->lookupString(scope, "mysql_host");
        mysql_username = cfg->lookupString(scope, "mysql_username");
        mysql_password = cfg->lookupString(scope, "mysql_password");
    }
    catch(const config4cpp::ConfigurationException & ex)
    {
        cerr << ex.c_str() << endl;
        cfg->destroy();
    }
}

SearchResult* DbController::doSearch(const char* req)
{
    Connection* conn = connect();
    Query query = conn->query();

    query << "SELECT * FROM website";
    StoreQueryResult ares = query.store();
    unsigned int numrow = ares.num_rows();
    SearchResult* results = new SearchResult[numrow];

    if(numrow == 0)
    {
        //Ajout d'un élément vide pour indiquer la taille
        SearchResult* aresult = new SearchResult();
        aresult->resultsLength = 0;
        results[0] = *aresult;
    }

    for(unsigned int i = 0; i < numrow; i++)
    {
        SearchResult* aresult = new SearchResult();
        string* titleR = new string(ares[i]["title"]);
        aresult->title = titleR;

        string* urlR = new string(ares[i]["url"]);
        aresult->url = urlR;

        string* decriptionR = new string(ares[i]["description"]);
        aresult->description = decriptionR;
        aresult->resultsLength = numrow;

        results[i] = *aresult;

        /*results[i]->title = ares[i]["title"];
        results[i]->url = ares[i]["url"];
        results[i]->description = ares[i]["desc"];
        results[i]->resultsLength = numrow;*/
    }

    return results;
}

Connection* DbController::connect()
{
    Connection* conn;
    try {
        conn = new Connection(false);
        conn->connect(mysql_database, mysql_host, mysql_username, mysql_password);
        return conn;
    } catch (BadQuery er){
        cerr << "Error: " << er.what() << endl;
        return NULL;
    }
}

void DbController::addSite(const char* url, const char* title, const char* description)
{
    Connection* conn = connect();
    Query query = conn->query();

    query << "INSERT INTO `website` (`title`, `description`, `url`) VALUES ('"
        << title << "','" << description << "','" << url << "');";
    query.execute();
}
