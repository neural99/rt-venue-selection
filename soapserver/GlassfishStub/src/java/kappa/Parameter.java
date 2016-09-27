/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

/**
 *
 * @author pelle
 */
public class Parameter {
    private String attribute;
    private String[] values;

    public String getAttribute() {
        return attribute;
    }

    public void setAttribute(String attribute) {
        this.attribute = attribute;
    }

    public String[] getValues() {
        return values;
    }

    public void setValues(String[] values) {
        this.values = values;
    }
}
