/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

import java.util.Calendar;

/**
 *
 * @author pelle
 */
public class Organisation {
    private int id;
    private Calendar regDatum;

    public Organisation() {
    }

    public Organisation(int id, Calendar regDatum) {
        this.id = id;
        this.regDatum = regDatum;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Calendar getRegDatum() {
        return regDatum;
    }
    public void setRegDatum(Calendar regDatum) {
        this.regDatum = regDatum;
    }
}
