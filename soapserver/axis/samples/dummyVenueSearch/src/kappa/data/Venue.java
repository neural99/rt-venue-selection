package kappa.data;

public class Venue {
	String category;
	String country;
	String colour;
	int dressingRooms;
	String venueName;
	String venueType;
	int lights;
	double riggingDistance;
	
	public String getCategory() {
		return category;
	}
	
	public String getCountry() {
		return country;
	}
	
	public String getColour() {
		return colour;
	}	
	
	public int getDressingRooms() {
		return dressingRooms;
	}
	
	public String getVenueName() {
		return venueName;
	}	
	public String getVenuType() {
		return venueType;
	}		
	
	public int getLights() {
		return lights;
	}
	
	public double getRiggingDistance() {
		return riggingDistance;
	}

	public Venue(String category, String country, String colour, int dressingRooms, String venueName, String venueType, int lights, double riggingDistance) {
		this.category = category;
		this.country = country;
		this.colour = colour;
		this.dressingRooms = dressingRooms;
		this.venueName = venueName;
		this.venueType = venueType;
		this.lights = lights;
		this.riggingDistance = riggingDistance;
	}
}