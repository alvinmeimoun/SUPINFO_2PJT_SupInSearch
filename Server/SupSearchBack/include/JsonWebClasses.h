#ifndef JSONWEBCLASSES_H
#define JSONWEBCLASSES_H

#include <string>

class SearchResult
{
    public:
        SearchResult();
        std::string* title;
        std::string* description;
        std::string* url;
        unsigned int resultsLength;
    protected:
    private:
};

#endif // JSONWEBCLASSES_H
