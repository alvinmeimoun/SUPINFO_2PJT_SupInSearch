#ifndef WEBMODEL_H
#define WEBMODEL_H

#include "DbController.h"
#include "../include/JsonWebClasses.h"

class WebModel
{
    public:
        WebModel(const char* configFilePath);
        const char* website_search(const char* req);
        DbController* dbController;

    protected:
    private:
        const char* configFile;
};

#endif // WEBMODEL_H
