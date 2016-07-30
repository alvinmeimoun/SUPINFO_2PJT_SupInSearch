#include "../include/JsonWebModel.h"
#include "../include/jsonlib/JSON.h"

#include <iostream>

JsonWebModel::JsonWebModel()
{
    //ctor
}

const char* fromWString(wstring owstring){
    string strValue;
    strValue.assign(owstring.begin(), owstring.end());

    const char* returnStr = strValue.c_str();
    return returnStr;
}

const wchar_t *wchartFromChar(const char *c)
{
    const size_t cSize = strlen(c)+1;
    wchar_t* wc = new wchar_t[cSize];
    mbstowcs (wc, c, cSize);

    return wc;
}

const char* JsonWebModel::strinifySearchResultArray(SearchResult* searchResults, int sizeA){
    JSONObject root;

    JSONArray jsarray;
    for(int i = 1; i < sizeA+1; i++){
        JSONObject result;

        cout << searchResults[i].title << endl;
        string* rTitle = searchResults[i].title;
        string rDescription = *searchResults[i].description;
        string rUrl = *searchResults[i].url;

        result[L"title"] = new JSONValue(wchartFromChar(rTitle->c_str()));
        result[L"description"] = new JSONValue(wchartFromChar(rDescription.c_str()));
        result[L"url"] = new JSONValue(wchartFromChar(rUrl.c_str()));
        JSONValue* resultVal = new JSONValue(result);

        jsarray.push_back(resultVal);
    }

    root[L"results"] = new JSONValue(jsarray);

    JSONValue* jvalue = new JSONValue(root);

    const char* returnStr = fromWString(jvalue->Stringify());
    //cout << returnStr << endl;
    delete jvalue;
    return returnStr;
}
