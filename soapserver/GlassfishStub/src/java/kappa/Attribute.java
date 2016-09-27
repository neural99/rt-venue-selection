/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

/**
 *
 * @author pelle
 */
public class Attribute {
    private String name;
    private String humanName;
    private String type;
    private int limit;
    private EnumElement[] elements;

    public Attribute() {
    }

    public Attribute(String name, String humanName, String type) {
        this.name = name;
        this.humanName = humanName;
        this.type = type;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getHumanName() {
        return humanName;
    }

    public void setHumanName(String humanName) {
        this.humanName = humanName;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public int getLimit() {
        return limit;
    }

    public void setLimit(int limit) {
        this.limit = limit;
    }

    public EnumElement[] getElements() {
        return elements;
    }

    public void setElements(EnumElement[] elements) {
        this.elements = elements;
    }
}
