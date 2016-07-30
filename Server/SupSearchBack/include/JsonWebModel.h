#ifndef JSONWEBMODEL_H
#define JSONWEBMODEL_H

#include "../include/JsonWebClasses.h"
#include <string.h>

using namespace std;

class JsonWebModel
{
    public:
        JsonWebModel();
        const char* strinifySearchResultArray(SearchResult* searchResults, int sizeA);
    protected:
    private:
};

#endif // JSONWEBMODEL_H
