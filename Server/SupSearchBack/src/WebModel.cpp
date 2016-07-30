#include "../include/WebModel.h"
#include "../include/JsonWebClasses.h"
#include "../include/JsonWebModel.h"

using namespace std;

WebModel::WebModel(const char* configFilePath)
{
    configFile = configFilePath;
    dbController = new DbController(configFilePath);
}

const char* WebModel::website_search(const char* req){
    //SearchResult* searchResults = dbController->doSearch(req);

    //unsigned int resultsLength = searchResults[0].resultsLength;

    //JsonWebModel* jsonWebModel = new JsonWebModel();

    return "";
    //return jsonWebModel->strinifySearchResultArray(results, resultsLength);
}

