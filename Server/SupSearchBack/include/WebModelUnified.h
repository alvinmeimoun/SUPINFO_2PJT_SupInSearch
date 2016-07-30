#ifndef WEBMODEL_H
#define WEBMODEL_H

#include "../include/jsonlib/JSON.h"
#include "../include/JsonWebClasses.h"
#include <config4cpp/Configuration.h>
#include <iostream>
#include <mysql++.h>
#include <boost/algorithm/string/split.hpp>
#include <boost/algorithm/string/classification.hpp>

using namespace std;
using namespace mysqlpp;

class WebModelUnified
{
    public:
        WebModelUnified(const char* configFilePath);
        const char* website_search(const char* req);
    protected:
        const wchar_t *wchartFromChar(const char *c);
        const char* fromWString(wstring owstring);
        mysqlpp::Connection* connect();
        string replaceChar(string str, char ch1, char ch2);
    private:
        const char* configFile;
        const char* mysql_host;
        const char* mysql_username;
        const char* mysql_password;
        const char* mysql_database;
};

#endif // WEBMODEL_H
