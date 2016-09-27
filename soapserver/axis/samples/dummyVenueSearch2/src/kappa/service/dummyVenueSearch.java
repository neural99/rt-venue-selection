package kappa.service;

import javax.xml.stream.XMLStreamException;
import javax.xml.namespace.QName;

import org.apache.axiom.om.OMAbstractFactory;
import org.apache.axiom.om.OMElement;
import org.apache.axiom.om.OMFactory;
import org.apache.axiom.om.OMNamespace;

public class dummyVenueSearch {

	private String namespace1 = "http://kappa.service.pojo";
	private String namespace2 = "http://kappa.schema";
    public OMElement search(OMElement element) throws XMLStreamException {
        element.build();
        element.detach();

		System.out.println("asdf");

        String returnText = "42";

        OMFactory fac = OMAbstractFactory.getOMFactory();
        OMNamespace omNs =
            fac.createOMNamespace(namespace1, "ns");
        OMElement method = fac.createOMElement("searchResponse", omNs);
        OMElement returnM= fac.createOMElement("return", omNs);
		OMNamespace omNs2 =
            fac.createOMNamespace(namespace2, "xs");
		OMElement structM = fac.createOMElement("venue", omNs2);
		OMElement value = fac.createOMElement("name", omNs);
        value.addChild(fac.createOMText(value, "Name1"));
		structM.addChild(value);
		returnM.addChild(structM);
        method.addChild(returnM);
        return method;
	}
}