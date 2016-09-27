/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

/**
 *
 * @author pelle
 */
public class Venue {
    private int id;
    private AttributeValue[] attributeValues;

    public Venue() {
    }

    public Venue(int id, AttributeValue[] values) {
        this.id = id;
        this.attributeValues = values;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public AttributeValue[] getAttributeValues() {
        return attributeValues;
    }

    public void setAttributeValues(AttributeValue[] attributeValues) {
        this.attributeValues = attributeValues;
    }
}
