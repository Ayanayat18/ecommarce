-- Seed data
INSERT INTO permissions (role, permission) VALUES
('editor','posts.manage'),('editor','projects.manage'),('editor','pages.manage'),('editor','media.manage');

INSERT INTO settings (`key`,`value`) VALUES
('site.name','Aurora Holdings'),('site.email','hello@example.com'),('site.phone','+880 1234 567 890');

INSERT INTO sliders (image, headline, subtext, cta_text, cta_url, sort_order) VALUES
('placeholders/slide1.jpg','Elevate Your Lifestyle','Spaces designed for modern city living','Explore Projects','/projects',1),
('placeholders/slide2.jpg','Address of Distinction','Quality that stands the test of time','Why Choose Us','/#why',2),
('placeholders/slide3.jpg','Built Around You','Crafted with care and precision','Contact Us','/contact',3);

INSERT INTO features (title, body, sort_order) VALUES
('Prime Locations','We build in vibrant, well-connected neighborhoods.',1),
('Quality Construction','Trusted materials and expert craftsmanship.',2),
('On-time Delivery','Our teams maintain timelines and transparency.',3),
('Responsive Support','We stay with you long after handover.',4),
('Thoughtful Design','Floor plans designed for real life.',5),
('Sustainable Choices','Energy efficient, future-friendly living.',6);

INSERT INTO partners (name, logo, sort_order) VALUES
('UrbanBank','placeholders/brand1.png',1),('CityTiles','placeholders/brand2.png',2),('GreenPower','placeholders/brand3.png',3),('FlyNet','placeholders/brand4.png',4);

-- 9 projects (3 per status)
INSERT INTO projects (title, slug, status, city, address, cover_image, handover_date, area_sqft, floors, units_total, overview, amenities, map_iframe, created_at) VALUES
('Aurora Heights I','aurora-heights-i','completed','Dhaka','123 Lake Rd','placeholders/p1.jpg','2022-12-01',120000,20,120,'Elegant residences in the heart of the city.','Gym, Rooftop, Community Hall','',NOW()),
('Aurora Heights II','aurora-heights-ii','completed','Dhaka','125 Lake Rd','placeholders/p2.jpg','2023-01-15',90000,18,100,'A sequel to our flagship address.','Play Zone, Solar Lighting','',NOW()),
('Skyline Plaza','skyline-plaza','completed','Chattogram','88 Bay Area','placeholders/p3.jpg','2021-07-10',150000,22,150,'Premium mixed-use development.','Mall Access, EV Chargers','',NOW()),
('Crescent Court','crescent-court','ongoing','Dhaka','78 Park St','placeholders/p4.jpg',NULL,110000,16,110,'Contemporary homes with green pockets.','Pool, Kids Area','',NOW()),
('Garden Vista','garden-vista','ongoing','Sylhet','45 Green Ave','placeholders/p5.jpg',NULL,95000,14,90,'Nature-forward living.','Garden Lounge, Yoga Deck','',NOW()),
('Harbor Residency','harbor-residency','ongoing','Chattogram','12 Harbor Rd','placeholders/p6.jpg',NULL,100000,15,95,'Bayside comfort and views.','Marina Walk, Sky Lounge','',NOW()),
('Nova Quarters','nova-quarters','upcoming','Dhaka','200 Ring Rd','placeholders/p7.jpg',NULL,130000,18,120,'Next-gen urban living.','Smart Access, Co-working','',NOW()),
('Summit Enclave','summit-enclave','upcoming','Khulna','55 Summit Rd','placeholders/p8.jpg',NULL,90000,12,80,'Value-centric, well-connected.','Clubhouse, Play Court','',NOW()),
('Riverfront One','riverfront-one','upcoming','Rajshahi','77 River Rd','placeholders/p9.jpg',NULL,105000,17,100,'Serene riverside lifestyle.','Jogging Track, BBQ Zone','',NOW());

-- galleries
INSERT INTO project_gallery (project_id, path, alt, sort_order)
SELECT p.id, CONCAT('placeholders/g', n, '.jpg'), CONCAT(p.title,' view ',n), n
FROM projects p CROSS JOIN (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) g;

-- units
INSERT INTO units (project_id, type, bedrooms, size_sqft, price, status)
SELECT p.id, 'Apartment', (FLOOR(RAND()*3)+2), (FLOOR(RAND()*800)+900), (FLOOR(RAND()*50)+50)*1000000, ELT(FLOOR(RAND()*3)+1,'available','booked','sold') FROM projects p LIMIT 54;

-- blog categories and tags
INSERT INTO categories (title, slug) VALUES ('Company News','company-news'),('Guides','guides');
INSERT INTO tags (title, slug) VALUES ('Real Estate','real-estate'),('Design','design'),('Investment','investment');

-- posts
INSERT INTO posts (title, slug, cover_image, excerpt, body, status, published_at, created_at)
VALUES
('Breaking ground at Crescent Court','breaking-ground-crescent','placeholders/b1.jpg','Work begins on our latest community.','<p>We are excited to begin work...</p>','published',NOW(),NOW()),
('How to choose a great apartment','choose-apartment','placeholders/b2.jpg','A simple checklist for home seekers.','<p>Size, light, location...</p>','published',NOW(),NOW()),
('Sustainable features explained','sustainable-features','placeholders/b3.jpg','Green choices that matter.','<p>Solar, insulation, low-flow...</p>','published',NOW(),NOW()),
('Inside Nova Quarters','inside-nova-quarters','placeholders/b4.jpg','A preview of our upcoming address.','<p>Concept renders and specs...</p>','published',NOW(),NOW()),
('Meet our design team','meet-design-team','placeholders/b5.jpg','People behind the blueprints.','<p>Our architects and designers...</p>','published',NOW(),NOW()),
('Handing over Aurora Heights II','handover-aurora2','placeholders/b6.jpg','Keys to new beginnings.','<p>We are delighted to hand over...</p>','published',NOW(),NOW());

-- csr posts
INSERT INTO csr_posts (title, slug, cover_image, excerpt, body, created_at)
VALUES
('Community Tree Plantation','tree-plantation','placeholders/c1.jpg','Greening our neighborhoods.','<p>Volunteers planted trees...</p>',NOW()),
('Scholarship Program','scholarship-program','placeholders/c2.jpg','Supporting education.','<p>We launched scholarships...</p>',NOW()),
('Flood Relief Mission','flood-relief','placeholders/c3.jpg','Standing by communities.','<p>Emergency supplies...</p>',NOW());

-- testimonials
INSERT INTO testimonials (name, photo, quote, created_at) VALUES
('Rahim Uddin',NULL,'Delighted with the quality and after-sales support.',NOW()),
('Nusrat Jahan',NULL,'Transparent communication and timely delivery.',NOW()),
('Tanvir Ahmed',NULL,'Excellent location and thoughtful layout.',NOW()),
('Sadia Karim',NULL,'A seamless home-buying experience.',NOW()),
('Arif Hasan',NULL,'They really care about customer needs.',NOW()),
('Mou Heera',NULL,'Would happily recommend to friends.',NOW());

-- team
INSERT INTO team (name, role, photo, bio, sort_order) VALUES
('Farhan Rahman','Chairman','placeholders/t1.jpg','Visionary leadership for sustainable growth.',1),
('Sara Ahmed','Managing Director','placeholders/t2.jpg','Driving innovation and service.',2),
('Imran Ali','Head of Projects','placeholders/t3.jpg','Delivering quality on time.',3),
('Lamia Chowdhury','Head of Design','placeholders/t4.jpg','Crafting human-centered spaces.',4),
('Nafis Khan','Head of Sales','placeholders/t5.jpg','Customer-first engagement.',5),
('Raisa Noor','Head of HR','placeholders/t6.jpg','People and culture champion.',6);

-- jobs
INSERT INTO jobs (title, slug, dept, type, location, excerpt, description, requirements, created_at) VALUES
('Project Manager','project-manager','Projects','Full-time','Dhaka','Lead delivery on site.','<p>Manage project teams...</p>','<ul><li>5+ years experience</li></ul>',NOW()),
('Architect','architect','Design','Full-time','Dhaka','Design thoughtful homes.','<p>Concept to detailed drawings...</p>','<ul><li>B.Arch</li></ul>',NOW()),
('Sales Executive','sales-executive','Sales','Full-time','Dhaka','Engage clients and close deals.','<p>Meet prospective buyers...</p>','<ul><li>Communication skills</li></ul>',NOW()),
('Marketing Associate','marketing-associate','Marketing','Full-time','Dhaka','Grow our brand presence.','<p>Campaigns and content...</p>','<ul><li>Digital marketing basics</li></ul>',NOW());

-- menu
INSERT INTO menus (name) VALUES ('primary');
INSERT INTO menu_items (menu_id, title, url, sort_order) VALUES
(1,'Home','/',1),(1,'About','/about',2),(1,'Projects','/projects',3),(1,'CSR','/csr',4),(1,'Career','/career',5),(1,'Blog','/blog',6),(1,'Contact','/contact',7);