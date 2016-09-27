<?php

/* List of attributes that are displayed in the GUI */

new AttributeGroup(
    'salj', 'Sälj', array(
        new StringAttribute('lokalnamn', 'Lokalnamn'),
        new EnumAttribute('land', 'Land'),
        new LanAttribute('lanId', 'Län'),
        new KommunAttribute('kommunId', 'Kommun'),
        new SpelplatsAttribute('spelplats', 'Spelplats'),
        // not implemented
        //new BooleanAttribute('harOrganisationer', 'Har organisationer'),
    )
);

new AttributeGroup(
    'teknik', 'Teknik', array(
        new NumericAttribute('antalPlatser', 'Antal platser', 20000),
        new EnumAttribute('farg', 'Färg'),
        new EnumAttribute('lokaltyp', 'Lokaltyp'),
        new NumericAttribute('logePlatser', 'Logeplatser', 50),
        new BooleanAttribute('riksteaterLokal', 'Riksteaterlokal'),
        new NumericAttribute('speldjup', 'Speldjup', 20000),
        new NumericAttribute('oppning', 'Öppning', 400000),
        new NumericAttribute('minHojd', 'Min. höjd', 300000),
        new NumericAttribute('scendjup', 'Scendjup', 900000),
        new NumericAttribute('scenbredd', 'Scenbredd', 1000000),
        new NumericAttribute('orkesteryta', 'Orkesteryta', 150),
        new BooleanAttribute('orkesterdike', 'Orkesterdike'),
        new NumericAttribute('scendjupNollan', 'Normalt scendjup', 11000),
        new NumericAttribute('proscenieHojd', 'Öppningshöjd', 15000, 'mm'),
        new NumericAttribute('teaterScenoppning', 'Teater scenöppning',
                             17000, 'mm'),
        new NumericAttribute('forscenRida', 'Förscen från ridå',
                             3500, 'mm'),
        new NumericAttribute('forscenNollan', 'Förscen från nollan',
                             5000, 'mm'),
        new NumericAttribute('forscenHojd', 'Förscen höjd',
                             1500, 'mm'),
        new NumericAttribute('lingangarMinMaxLast',
                             'Lingångar: minsta maxlast', 500),
        new NumericAttribute('antalLingangarSpeldjup', 'Antal lingångar', 40),
        new NumericAttribute('antLyssn', 'Antal lyssnare', 800),
        new NumericAttribute('antStatistik', 'Antal statistik', 4500),
    )
);

new AttributeGroup(
    'ovrigt', 'Övrigt', array(
        new EnumAttribute('kategori', 'Kategori'),
        new StringAttribute('adress1', 'Adress 1'),
        new StringAttribute('adress2', 'Adress 2'),
        new StringAttribute('postnr', 'Postnr'),
        new StringAttribute('postord', 'Postort'),
        new StringAttribute('telefon', 'Telefonnr'),
        new StringAttribute('telefax', 'Telefax'),
        new StringAttribute('epost', 'E-post'),
        new StringAttribute('http', 'Webbadress'),
        new NumericAttribute('ovToa', 'Antal WC', 50),
        new NumericAttribute('ovDusch', 'Antal duschar', 15),
        new BooleanAttribute('omklTeknik', 'Omkl. teknik'),
        new BooleanAttribute('uttagTvatt', 'Uttag tvätt'),
        new StringAttribute('inlastLoge', 'Inlast loge'),
        new BooleanAttribute('instick', 'Instick'),
        new StringAttribute('manover', 'Manöver'),
        new NumericAttribute('extraByggtid', 'Extra byggtid', 60),
        new NumericAttribute('extraRivtid', 'Extra rivtid', 60),
        new StringAttribute('tidstillaggIn', 'Tidstillägg inlastning'),
        new StringAttribute('tidstillaggUt', 'Tidstillägg utlastning'),
        new StringAttribute('orsak', 'Orsak'),
        new BooleanAttribute('mingel', 'Mingel'),
        new NumericAttribute('mingelYta', 'Mingelyta', 100),
    )
);
