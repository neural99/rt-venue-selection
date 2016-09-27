/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package kappa;

/**
 *
 * @author pelle
 */
public class SearchResult {
    private Venue[] venues;
    private Organisation[] organisations;

    public SearchResult() {
    }

    public SearchResult(Venue[] venues, Organisation[] organisations) {
        this.venues = venues;
        this.organisations = organisations;
    }

    public Venue[] getVenues() {
        return venues;
    }

    public void setVenues(Venue[] venues) {
        this.venues = venues;
    }

    public Organisation[] getOrganisations() {
        return organisations;
    }

    public void setOrganisations(Organisation[] organisations) {
        this.organisations = organisations;
    }

}
