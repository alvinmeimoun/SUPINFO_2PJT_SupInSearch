#ifndef DBCONTROLLER_H
#define DBCONTROLLER_H

#include "JsonWebClasses.h"
#include <config4cpp/Configuration.h>
#include <iostream>
#include <mysql++.h>

using namespace std;
using namespace mysqlpp;

class DbController
{
    public:
        DbController(const char* configFilePath);
        SearchResult* doSearch(const char* req);
        void addSite(const char* url, const char* title, const char* description);
    protected:
        mysqlpp::Connection* connect();
    private:
        const char* configFile;
        const char* mysql_host;
        const char* mysql_username;
        const char* mysql_password;
        const char* mysql_database;

};

#endif // DBCONTROLLER_H
