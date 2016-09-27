/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

import javax.jws.WebService;
import javax.jws.WebParam;
import java.util.GregorianCalendar;

/**
 *
 * @author pelle
 */
@WebService()
public class VenueSelection {
    public Attribute[] getAttributes() {
        Attribute a1 = new Attribute("lokalnamn", "Lokalnamn", "string");
        Attribute a2 = new Attribute("antalPlatser", "Antal platser", "numeric");
        Attribute a3 = new Attribute("lanId", "Län", "enum");
        Attribute a4 = new Attribute("riksteaterlokal", "Riksteaterlokal",
                "boolean");

        a2.setLimit(100000);

        EnumElement[] elements = {
            new EnumElement("01", "Stockholms län"),
            new EnumElement("02", "Norrköpings län")
        };
        a3.setElements(elements);

        Attribute[] attrs = { a1, a2, a3, a4 };
        return attrs;
    }

    public SearchResult search(@WebParam(name="q") Query q) {
        AttributeValue values[] = {
            new AttributeValue("lokalnamn", "Södra teatern"),
            new AttributeValue("antalPlatser", "1000"),
            new AttributeValue("lanId", "01"),
            new AttributeValue("riksteaterlokal", "1")
        };
        Venue v1 = new Venue(1, values);
        Venue v2 = new Venue(2, values);
        Venue[] venues = { v1, v2 };

        Organisation[] orgs = {
            new Organisation(1, new GregorianCalendar(2005, 5, 5)),
            new Organisation(2, new GregorianCalendar(1999, 3, 3))
        };

        return new SearchResult(venues, orgs);
    }
}
