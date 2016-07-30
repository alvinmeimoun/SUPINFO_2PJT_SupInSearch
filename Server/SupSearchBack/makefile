WORKDIR = `pwd`

CC = gcc
CXX = g++
AR = ar
LD = g++
WINDRES = windres

INC = -Ilibs/include -I/usr/include/mysql++ -I/usr/include/mysql
CFLAGS =  -Wall -fexceptions
RESINC = 
LIBDIR = 
LIB = libs/lib/libconfig4cpp.a
LDFLAGS = -lpthread -lmicrohttpd -lmysqlpp

INC_DEBUG =  $(INC) 
CFLAGS_DEBUG =  $(CFLAGS) -g
RESINC_DEBUG =  $(RESINC)
RCFLAGS_DEBUG =  $(RCFLAGS)
LIBDIR_DEBUG =  $(LIBDIR)
LIB_DEBUG = $(LIB) 
LDFLAGS_DEBUG = $(LDFLAGS)
OBJDIR_DEBUG = obj/Debug
DEP_DEBUG = 
OUT_DEBUG = bin/Debug/SupSearchBack

INC_RELEASE =  $(INC)
CFLAGS_RELEASE =  $(CFLAGS) -O2
RESINC_RELEASE =  $(RESINC)
RCFLAGS_RELEASE =  $(RCFLAGS)
LIBDIR_RELEASE =  $(LIBDIR)
LIB_RELEASE = $(LIB)
LDFLAGS_RELEASE =  $(LDFLAGS) -s
OBJDIR_RELEASE = obj/Release
DEP_RELEASE = 
OUT_RELEASE = insearch-server

OBJ_DEBUG = $(OBJDIR_DEBUG)/main.o $(OBJDIR_DEBUG)/src/DbController.o $(OBJDIR_DEBUG)/src/JsonWebClasses.o $(OBJDIR_DEBUG)/src/JsonWebModel.o $(OBJDIR_DEBUG)/src/WebModel.o $(OBJDIR_DEBUG)/src/WebModelUnified.o $(OBJDIR_DEBUG)/src/jsonlib/JSON.o $(OBJDIR_DEBUG)/src/jsonlib/JSONValue.o

OBJ_RELEASE = $(OBJDIR_RELEASE)/main.o $(OBJDIR_RELEASE)/src/DbController.o $(OBJDIR_RELEASE)/src/JsonWebClasses.o $(OBJDIR_RELEASE)/src/JsonWebModel.o $(OBJDIR_RELEASE)/src/WebModel.o $(OBJDIR_RELEASE)/src/WebModelUnified.o $(OBJDIR_RELEASE)/src/jsonlib/JSON.o $(OBJDIR_RELEASE)/src/jsonlib/JSONValue.o

all: release

clean: clean_debug clean_release

before_debug: 
	test -d bin/Debug || mkdir -p bin/Debug
	test -d $(OBJDIR_DEBUG) || mkdir -p $(OBJDIR_DEBUG)
	test -d $(OBJDIR_DEBUG)/src || mkdir -p $(OBJDIR_DEBUG)/src
	test -d $(OBJDIR_DEBUG)/src/jsonlib || mkdir -p $(OBJDIR_DEBUG)/src/jsonlib

after_debug: 

debug: before_debug out_debug after_debug

out_debug: $(OBJ_DEBUG) $(DEP_DEBUG)
	$(LD) $(LDFLAGS_DEBUG) $(LIBDIR_DEBUG) $(OBJ_DEBUG) $(LIB_DEBUG) -o $(OUT_DEBUG)

$(OBJDIR_DEBUG)/main.o: main.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c main.cpp -o $(OBJDIR_DEBUG)/main.o

$(OBJDIR_DEBUG)/src/DbController.o: src/DbController.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/DbController.cpp -o $(OBJDIR_DEBUG)/src/DbController.o

$(OBJDIR_DEBUG)/src/JsonWebClasses.o: src/JsonWebClasses.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/JsonWebClasses.cpp -o $(OBJDIR_DEBUG)/src/JsonWebClasses.o

$(OBJDIR_DEBUG)/src/JsonWebModel.o: src/JsonWebModel.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/JsonWebModel.cpp -o $(OBJDIR_DEBUG)/src/JsonWebModel.o

$(OBJDIR_DEBUG)/src/WebModel.o: src/WebModel.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/WebModel.cpp -o $(OBJDIR_DEBUG)/src/WebModel.o

$(OBJDIR_DEBUG)/src/WebModelUnified.o: src/WebModelUnified.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/WebModelUnified.cpp -o $(OBJDIR_DEBUG)/src/WebModelUnified.o

$(OBJDIR_DEBUG)/src/jsonlib/JSON.o: src/jsonlib/JSON.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/jsonlib/JSON.cpp -o $(OBJDIR_DEBUG)/src/jsonlib/JSON.o

$(OBJDIR_DEBUG)/src/jsonlib/JSONValue.o: src/jsonlib/JSONValue.cpp
	$(CXX) $(CFLAGS_DEBUG) $(INC_DEBUG) -c src/jsonlib/JSONValue.cpp -o $(OBJDIR_DEBUG)/src/jsonlib/JSONValue.o

clean_debug: 
	rm -f $(OBJ_DEBUG) $(OUT_DEBUG)
	rm -rf bin/Debug
	rm -rf $(OBJDIR_DEBUG)
	rm -rf $(OBJDIR_DEBUG)/src
	rm -rf $(OBJDIR_DEBUG)/src/jsonlib

before_release: 
	test -d bin/Release || mkdir -p bin/Release
	test -d $(OBJDIR_RELEASE) || mkdir -p $(OBJDIR_RELEASE)
	test -d $(OBJDIR_RELEASE)/src || mkdir -p $(OBJDIR_RELEASE)/src
	test -d $(OBJDIR_RELEASE)/src/jsonlib || mkdir -p $(OBJDIR_RELEASE)/src/jsonlib

after_release: 

release: before_release out_release after_release

out_release: $(OBJ_RELEASE) $(DEP_RELEASE)
	$(LD) $(LDFLAGS_RELEASE) $(LIBDIR_RELEASE) $(OBJ_RELEASE) $(LIB_RELEASE) -o $(OUT_RELEASE)

$(OBJDIR_RELEASE)/main.o: main.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c main.cpp -o $(OBJDIR_RELEASE)/main.o

$(OBJDIR_RELEASE)/src/DbController.o: src/DbController.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/DbController.cpp -o $(OBJDIR_RELEASE)/src/DbController.o

$(OBJDIR_RELEASE)/src/JsonWebClasses.o: src/JsonWebClasses.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/JsonWebClasses.cpp -o $(OBJDIR_RELEASE)/src/JsonWebClasses.o

$(OBJDIR_RELEASE)/src/JsonWebModel.o: src/JsonWebModel.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/JsonWebModel.cpp -o $(OBJDIR_RELEASE)/src/JsonWebModel.o

$(OBJDIR_RELEASE)/src/WebModel.o: src/WebModel.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/WebModel.cpp -o $(OBJDIR_RELEASE)/src/WebModel.o

$(OBJDIR_RELEASE)/src/WebModelUnified.o: src/WebModelUnified.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/WebModelUnified.cpp -o $(OBJDIR_RELEASE)/src/WebModelUnified.o

$(OBJDIR_RELEASE)/src/jsonlib/JSON.o: src/jsonlib/JSON.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/jsonlib/JSON.cpp -o $(OBJDIR_RELEASE)/src/jsonlib/JSON.o

$(OBJDIR_RELEASE)/src/jsonlib/JSONValue.o: src/jsonlib/JSONValue.cpp
	$(CXX) $(CFLAGS_RELEASE) $(INC_RELEASE) -c src/jsonlib/JSONValue.cpp -o $(OBJDIR_RELEASE)/src/jsonlib/JSONValue.o

clean_release: 
	rm -f $(OBJ_RELEASE) $(OUT_RELEASE)
	rm -rf bin/Release
	rm -rf $(OBJDIR_RELEASE)
	rm -rf $(OBJDIR_RELEASE)/src
	rm -rf $(OBJDIR_RELEASE)/src/jsonlib

.PHONY: before_debug after_debug clean_debug before_release after_release clean_release

