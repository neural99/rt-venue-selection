import logging
import traceback as tb
import suds.metrics as metrics
from suds import WebFault
from suds.client import Client
url = 'http://localhost:8080/axis2/services/dummyVenueSearch?wsdl'
c = Client(url)
r = c.service.search("a","b","c",0,"d","e",1,2.0)

print r
