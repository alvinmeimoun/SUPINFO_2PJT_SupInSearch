#include "../include/WebModelUnified.h"

WebModelUnified::WebModelUnified(const char* configFilePath)
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

const char* WebModelUnified::website_search(const char* req){
    JSONObject root;
    JSONArray jsarray;
    Connection* conn = connect();
    Query query = conn->query();

    string reqstr(req);
    string reqstr_spaced = replaceChar(reqstr, '+', ' ');
    vector<string> splittedstr;
    split(splittedstr, reqstr_spaced, boost::algorithm::is_any_of(" "));

    int titleForce = 10;
    int descriptionForce = 1;
    int urlForce = 3;

    query << "SELECT * , ";
    //Occurences total
    for(size_t i1 = 0; i1 < splittedstr.size(); i1++)
    {
        string s = splittedstr[i1];
        if(i1 != 0){
            query << " + ";
        }

        query << "((" <<
          titleForce << " * (char_length(title) - char_length(replace(title,'" << s << "',''))) + " <<
          descriptionForce << " * (char_length(description) - char_length(replace(description,'" << s << "',''))) + " <<
          urlForce << " * (char_length(url) - char_length(replace(url,'" << s << "','')))" <<
        ") / char_length('" << s << "'))";
    }
    query << " as Occurances " << " FROM website ";

    //Where clause
    for(size_t i1 = 0; i1 < splittedstr.size(); i1++)
    {
        string s = splittedstr[i1];
        if(i1 == 0) {
            query << "WHERE ";
        } else {
            query << "OR ";
        }
        query << "(url LIKE '%" << s << "%' or title LIKE '%" << s << "%' or description LIKE '%" << s << "%') ";
    }

    query << " ORDER BY " << "Occurances desc, title ASC ";

    StoreQueryResult ares = query.store();
    unsigned int numrow = ares.num_rows();

    for(unsigned int i = 0; i < numrow; i++)
    {
        JSONObject result;

        result[L"title"] = new JSONValue(wchartFromChar(ares[i]["title"]));
        result[L"description"] = new JSONValue(wchartFromChar(ares[i]["description"]));
        result[L"url"] = new JSONValue(wchartFromChar(ares[i]["url"]));
        JSONValue* resultVal = new JSONValue(result);

        jsarray.push_back(resultVal);
    }

    root[L"results"] = new JSONValue(jsarray);

    JSONValue* jvalue = new JSONValue(root);

    const char* returnStr = fromWString(jvalue->Stringify());
    delete jvalue;
    return returnStr;
}

//utils
const char* WebModelUnified::fromWString(wstring owstring){
    string strValue;
    strValue.assign(owstring.begin(), owstring.end());

    const char* returnStr = strValue.c_str();
    return returnStr;
}

const wchar_t *WebModelUnified::wchartFromChar(const char *c)
{
    const size_t cSize = strlen(c)+1;
    wchar_t* wc = new wchar_t[cSize];
    mbstowcs (wc, c, cSize);

    return wc;
}

string WebModelUnified::replaceChar(string str, char ch1, char ch2) {
  for (unsigned int i = 0; i < str.length(); ++i) {
    if (str[i] == ch1)
      str[i] = ch2;
  }

  return str;
}

Connection* WebModelUnified::connect()
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
