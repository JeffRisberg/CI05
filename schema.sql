drop table if exists comments;
drop table if exists posts;
drop table if exists entity_qualifier_value;
drop table if exists qualifier_values;
drop table if exists qualifiers;

create table qualifiers (
  id int(11) NOT NULL AUTO_INCREMENT,
  seq_num int(11) NOT NULL,
  name varchar(100) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

create table qualifier_values (
  id int(11) NOT NULL AUTO_INCREMENT,
  qualifier_id int(11) NOT NULL,
  value varchar(100) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (qualifier_id) REFERENCES qualifiers (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

create table entity_qualifier_value (
  id int(11) NOT NULL AUTO_INCREMENT,
  entity_type varchar(50) NOT NULL,
  entity_id int(11) NOT NULL,
  qualifier_value_id int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (qualifier_value_id) REFERENCES qualifier_values (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

create table posts (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  body text NOT NULL,
  image varchar(255) NULL,
  date_created datetime NOT NULL,
  last_updated datetime NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

create table comments (
  id int(11) NOT NULL AUTO_INCREMENT,
  post_id int(11) NOT NULL, 
  title varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  body text NOT NULL,
  date_created datetime NOT NULL,
  last_updated datetime NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(post_id) REFERENCES posts(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

insert into qualifiers (id, seq_num, name, description) values (1, 1, 'Resources', 'Resources desc');
insert into qualifiers (id, seq_num, name, description) values (2, 1, 'Industries', 'Industries desc');

insert into qualifier_values (id, qualifier_id, value) values (1, 1, 'Water');
insert into qualifier_values (id, qualifier_id, value) values (2, 1, 'Information');
insert into qualifier_values (id, qualifier_id, value) values (3, 1, 'Materials');
insert into qualifier_values (id, qualifier_id, value) values (4, 1, 'Energy');

insert into qualifier_values (id, qualifier_id, value) values (10, 2, 'Manufacturing');
insert into qualifier_values (id, qualifier_id, value) values (11, 2, 'Finance');
insert into qualifier_values (id, qualifier_id, value) values (12, 2, 'Entertainment');
insert into qualifier_values (id, qualifier_id, value) values (13, 2, 'Education');
insert into qualifier_values (id, qualifier_id, value) values (14, 2, 'Government');
insert into qualifier_values (id, qualifier_id, value) values (15, 2, 'Real Estate');
insert into qualifier_values (id, qualifier_id, value) values (16, 2, 'Household');
insert into qualifier_values (id, qualifier_id, value) values (17, 2, 'Other');

insert into posts (title, body, date_created) values
('Paper usage in finance industry', 
'Sustainability leaders are helping firms reduce the amount of paper usage, by reducing printing of documents.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 1, 3);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 1, 11);

insert into posts (title, body, date_created) values
('Recycling of plastics', 
'Have you considered the amount of plastic used within a household, particularly in toys?  Why not re-use old toys?', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 2, 3);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 2, 12);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 2, 16);

insert into posts (title, body, date_created) values
('Energy reductions in manufacturing', 
'In North America, manufacturing accounts for 44% of energy usage.  Most is in buildings, the rest in plants and plant operations.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 3, 4);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 3, 10);

insert into posts (title, body, date_created) values
('Biogradable consumer plastics', 
'A new startup in Menlo Park is introducing the first biodegradable plastic bagging.  This can save considerable amounts of materials sent to landfills.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 4, 3);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 4, 16);

insert into posts (title, body, date_created) values
('Water savings is energy reduction', 
'Every gallon of water saved is also a reduction in energy usage, since energy is consumed to process and pump water.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 5, 1);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 5, 4);

insert into posts (title, body, date_created) values
('Government mandates new energy conservation measures', 
'The EPA is expending the Energy Star program to include new devices and equipment.  Manufacturers will be introducing models as a result.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 6, 4);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 6, 14);

insert into posts (title, body, date_created) values
('Solar industry expected to grow in 2012', 
'The pricing of solar panels and other equipment will be reduced during the year, creating new opportunities for solar renewable energy.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 7, 4);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 7, 10);

insert into posts (title, body, date_created) values
('Graywater can be used for household non-potable water needs', 
'Many households are now installing graywater recovery devices in the laundry and shower systems, which extract gray water for use in watering your lawn.', 
now());
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 8, 1);
insert into entity_qualifier_value (entity_type, entity_id, qualifier_value_id) values ('POST', 8, 16);

