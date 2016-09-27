/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

/**
 *
 * @author pelle
 */
public class AttributeValue {
    private String attribute;
    private String value;

    public AttributeValue() {
    }

    public AttributeValue(String attribute, String value) {
        this.attribute = attribute;
        this.value = value;
    }

    

    public String getAttribute() {
        return attribute;
    }

    public void setAttribute(String attribute) {
        this.attribute = attribute;
    }

    public String getValue() {
        return value;
    }

    public void setValue(String value) {
        this.value = value;
    }
}
