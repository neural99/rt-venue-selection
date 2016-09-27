package kappa.service;

import kappa.data.Venue;

import java.util.ArrayList;

public class dummyVenueSearch {
	private ArrayList<Venue> list;
	public String[][] getParameters() {
		String[][] c = { {"Category", "String"}, 
		                 {"Country", "String"},
						 {"Colour", "String"},
						 {"DressingRooms", "Integer"},
						 {"VenueName", "String"},
						 {"VenueType", "String"},
						 {"Lights", "Integer"},
						 {"RiggingDistance", "Double"} };

		return c;
	}
	
	private void addData() {
		list = new ArrayList<Venue>();
		list.add(new Venue("Category 1", "Sweden", "Blue", 1, "Name1", "Type1", 12, 14.5));
		list.add(new Venue("Category 2", "Norway", "Super-green", 2, "Name2", "Type2", 12, 14.5));
	}
	
	public Venue[] search(String category, String country, String colour, int rooms, String name, String type, int lights, double distance) {
		addData();
		Venue[] c = new Venue[2];
		c[0] = list.get(0);
		c[1] = list.get(1);
		return c;
	}
}