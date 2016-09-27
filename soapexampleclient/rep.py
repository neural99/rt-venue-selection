import logging
import traceback as tb
import suds.metrics as metrics
from suds import WebFault
from suds.client import Client
url = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/RepertoarWSService?wsdl'
c = Client(url, username='webla', password='HLlmfe7FlgB6')
r = c.service.GetRepertoarList(10, 0, 0, 0, 0,[],[],0,0,True)
print r
print c
for t in r.retValRepertoarElement:
	print str(t.showDate) + "\t" + t.title
