-- Centauro Tables
-- Chipotle Software (c) 2006-2011

CREATE TABLE groups (
  "id" serial PRIMARY KEY,
  "name" varchar(50) NOT NULL UNIQUE,
  "description" varchar(150) NOT NULL
);

CREATE TABLE licenses (     -- Licencias
   "id" serial PRIMARY KEY,
   "type" varchar(120) NOT NULL UNIQUE,
   "url" varchar(190) NOT NULL UNIQUE,
   "img" varchar(70) NOT NULL UNIQUE
);

CREATE TABLE cake_sessions (
   "id" varchar(255) NOT NULL DEFAULT '' PRIMARY KEY,
   "data" text,
   "expires" int
);

-- Helps /help in sections
CREATE TABLE helps (
 id serial PRIMARY KEY,
 url varchar(100) NOT NULL,
 help text NOT NULL,
 lang varchar(2) NOT NULL DEFAULT 'en',
 title varchar(80) NOT NULL
);

CREATE TABLE langs (
  id serial PRIMARY KEY,
  lang varchar(50) NOT NULL,
  locale varchar(6) NOT NULL
);

-- Name: users; Type: TABLE; Schema: public; Owner: www-data; Tablespace: 
CREATE TABLE users (
    id serial PRIMARY KEY,
    username varchar(50) NOT NULL UNIQUE, --login
    pwd  varchar(32)  NOT NULL,
    name  varchar(70)  NOT NULL,     --real name
    email  varchar(45)  NOT NULL UNIQUE,
    last_visit timestamp(0) with time zone DEFAULT now() NOT NULL,
    group_id integer NOT NULL,                                                     -- Admin, normal user
    created timestamp(0) with time zone DEFAULT now() NOT NULL,
    modified timestamp(0) with time zone DEFAULT now() NOT NULL,
    website  varchar(500),
    cv text,
    lang varchar(3) DEFAULT 'es',   -- english by default
    avatar  varchar(100) DEFAULT 'default-avatar.jpg' NOT NULL,
    "quote"  varchar(150),
    name_blog  varchar(150),
    license_id smallint REFERENCES licenses(id) ON DELETE CASCADE NOT NULL DEFAULT 6,  -- kind of license selecte dby the user
    livechat smallint NOT NULL DEFAULT 1,  -- active ajax chat on blog
    wiwd smallint NOT NULL DEFAULT 1,   -- what I was doing 
    active smallint NOT NULL DEFAULT 0,  -- active =1, desactived = 0
    tags text NOT NULL DEFAULT 'arts, music, hacking, environment, education, pets',
    fck boolean NOT NULL DEFAULT True
);

-- users avatars by default
CREATE TABLE avatars (
    id serial PRIMARY KEY,
    name  varchar(50)  NOT NULL
);

-- Google maps
CREATE TABLE markers (
   "id" serial PRIMARY KEY,
   "name"  varchar(60) NOT NULL,
   "address" varchar(80) NOT NULL,
   "lat"  real  NOT NULL,
   "lng"  real   NOT NULL,
   "type" varchar(30) NOT NULL,
   "user_id" int REFERENCES users(id) ON DELETE CASCADE NOT NULL
);

--Forums tables
CREATE TABLE catforums (  -- phorums categories
 id serial PRIMARY KEY,
 title varchar(150) NOT NULL,
 description varchar(150) NOT NULL,
 created timestamp(0) with time zone DEFAULT now() NOT NULL,
 user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
 status int NOT NULL DEFAULT 0, -- Activated = 1,  Deactivated=0
 website int NOT NULL DEFAULT 0  -- website forums
);

CREATE TABLE forums (
 id serial PRIMARY KEY,
 title varchar(150) NOT NULL,
 description varchar(500) NOT NULL,
 user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
 catforum_id integer NOT NULL REFERENCES catforums(id) ON DELETE CASCADE,
 status int NOT NULL DEFAULT 0  -- Activated = 1,  Deactivated=0
);

CREATE TABLE topics ( -- question and aswers in phorums  
 id serial PRIMARY KEY,
 subject varchar(150) NOT NULL,
 message text NOT NULL,
 created timestamp(0) with time zone DEFAULT now() NOT NULL,
 forum_id integer NOT NULL REFERENCES forums(id) ON DELETE CASCADE,
 user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
 status int NOT NULL DEFAULT 0,
 level int NOT NULL DEFAULT 0,
 topic_id int NOT NULL DEFAULT 0,
 views int NOT NULL DEFAULT 0  -- number of times the topic has been seen
);

CREATE TABLE replies ( --  aswers in phorums  
 id serial PRIMARY KEY,
 title varchar(150) NOT NULL,
 body text NOT NULL,
 created timestamp(0) with time zone DEFAULT now() NOT NULL,
 topic_id integer NOT NULL REFERENCES topics(id) ON DELETE CASCADE,
 user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
 status int NOT NULL DEFAULT 0
 );
--ends forums tables 

-- bloggers Bookmarks links
CREATE TABLE bookmarks (
   id serial PRIMARY KEY,
   name varchar(50) NOT NULL,
   url varchar(300) NOT NULL,
   tags varchar(300) NOT NULL,
   user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
   created timestamp(0) with time zone DEFAULT now() NOT NULL
);

CREATE TABLE catdownloads (
   id serial PRIMARY KEY,
   title varchar(100) NOT NULL
);


CREATE TABLE downloads (
   id serial PRIMARY KEY,
   title varchar(100) NOT NULL,
   description text NOT NULL,
   catdownload_id int NOT NULL REFERENCES catdownloads(id) ON DELETE CASCADE,
   "user_id" int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
   url varchar(200) NOT NULL
 );

--detalles del sitio
CREATE TABLE websites (
  id serial PRIMARY KEY,
  urlbase varchar(150) NOT NULL,
  name varchar(150) NOT NULL,
  slogan varchar(100) NOT NULL,
  email varchar(40) NOT NULL,
  keywords varchar(200) NOT NULL,
  description varchar(100) NOT NULL,
  author varchar(35) NOT NULL,
  organization varchar(45) NOT NULL
);



CREATE TABLE themes (  -- News themes
id serial PRIMARY KEY,
theme varchar(40) NOT NULL,
description varchar(400) NOT NULL,
img varchar(80) NOT NULL
);

-- Messages between users
CREATE TABLE messages (
    "id" serial PRIMARY KEY,
    "title" varchar(90) NOT NULL,
    "body" text NOT NULL,
    "created" timestamp(0) with time zone DEFAULT now() NOT NULL,
    "level" integer NOT NULL DEFAULT 0,  -- build the message thread if reply exist
    "sender_id" integer NOT NULL DEFAULT 0, -- Who send the message
    "user_id" integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,  -- Who receive the message
    "readed" smallint NOT NULL DEFAULT 0, -- recipient has readed the message?
    "status" smallint NOT NULL DEFAULT 0
);

CREATE TABLE news (     -- News on index
id serial PRIMARY KEY,
title varchar(250) NOT NULL,
body text NOT NULL,
created timestamp(0) with time zone DEFAULT now() NOT NULL,
reference varchar(350), -- can be null
theme_id int NOT NULL REFERENCES themes(id) ON DELETE CASCADE,
status int NOT NULL,   -- 0 = draft, 1 = publicado
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
votes int NOT NULL DEFAULT 0,
comments int NOT NULL DEFAULT 0  -- are the conment actived?
);


CREATE TABLE quicks (     -- quick news
id serial PRIMARY KEY,
title varchar(250) NOT NULL,
reference varchar(350) NOT NULL UNIQUE, -- url to new
site varchar(90) NOT NULL,  -- site from new comes
votes smallint NOT NULL DEFAULT 0,
theme_id int NOT NULL REFERENCES themes(id) ON DELETE CASCADE,
created timestamp(0) with time zone DEFAULT now() NOT NULL,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE quicks_comments (     -- quick comments
id serial PRIMARY KEY,
quick_id int NOT NULL REFERENCES quicks(id) ON DELETE CASCADE,
comment text NOT NULL,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
created timestamp(0) with time zone DEFAULT now() NOT NULL
);

CREATE TABLE quicks_votes (     -- quick comments
id serial PRIMARY KEY,
quick_id int NOT NULL REFERENCES quicks(id) ON DELETE CASCADE,
vote smallint NOT NULL,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- Confirm user table to use in registration site process
CREATE TABLE confirms ( 
 id serial PRIMARY KEY,
 user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
 created timestamp(0) with time zone DEFAULT now() NOT NULL,
 secret varchar(16) NOT NULL,
 CHECK ( length(secret)  > 13  )
);

-- Free lancers
CREATE TABLE freelancers ( 
 id serial PRIMARY KEY,
 user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
 created timestamp(0) with time zone DEFAULT now() NOT NULL,
 habilities text NOT NULL,
 disponibility varchar(90) NOT NULL,
 wage varchar(90) NOT NULL,
 status int NOT NULL DEFAULT 0  -- active =1, desactived = 0 
);


CREATE TABLE livechats (     -- Live Chat
id serial PRIMARY KEY,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE NOT NULL,
message varchar(130) NOT NULL,
sender_name varchar(13) NOT NULL, --sender_id int NOT NULL DEFAULT 0, maybe later
"created" timestamp(0) with time zone DEFAULT now() NOT NULL
);


-- temas podecast
CREATE TABLE temaspods (
 id serial PRIMARY KEY,
 title varchar(50) NOT NULL UNIQUE
);


-- Podcasts
CREATE TABLE "podcasts" (
"id" serial PRIMARY KEY, 
"title" varchar(50) NOT NULL DEFAULT '', 
"description" varchar(255) NOT NULL DEFAULT '', 
"created" timestamp(0) with time zone NOT NULL DEFAULT now(),
"length" varchar(10) NOT NULL DEFAULT 0,
"duration" varchar(8) NOT NULL DEFAULT '',
"filename" varchar(100) NOT NULL,
"keywords" varchar(255) NOT NULL DEFAULT '',
"user_id" int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
"status" int NOT NULL DEFAULT 0
);

CREATE TABLE poddatas (     -- podcasts data 
id serial PRIMARY KEY,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
copyright varchar(150),
subtitle  varchar(180),
summary   varchar(200),
description varchar(250),
category int NOT NULL REFERENCES temaspods(id) ON DELETE CASCADE,
keywords varchar(180),
explicit int NOT NULL DEFAULT 1,
"created" timestamp(0) with time zone DEFAULT now() NOT NULL
);

CREATE TABLE styles (     -- CSS Styles to each blogger
"id" serial PRIMARY KEY,
"user_id" int NOT NULL UNIQUE,
"style" text NOT NULL
);

CREATE TABLE quotes (
id serial PRIMARY KEY,
quote varchar(150) NOT NULL,
author varchar(70) NOT NULL,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- what are you doing?
CREATE TABLE waydings (
id serial PRIMARY KEY,
task varchar(80) NOT NULL,
created timestamp(0) NOT NULL DEFAULT now(),
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- Share it!
CREATE TABLE shares (
id serial PRIMARY KEY,
"file" varchar(50) UNIQUE NOT NULL,
"description" varchar(150) NOT NULL,
"user_id" int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
"created" timestamp(0) with time zone DEFAULT now() NOT NULL,
"secret"  varchar(16) NOT NULL UNIQUE, -- the secret reference
"public" int NOT NULL DEFAULT 0  --shareable?
);

CREATE TABLE sections ( -- Las sections que organizan las poginas con el menu de la izquierda
"id" serial PRIMARY KEY,
"description" varchar(50) NOT NULL,
"order" numeric NOT NULL,
"img" varchar(60) NOT NULL
);

-- Sections blogs
CREATE TABLE themeblogs (
 id serial PRIMARY KEY,
 title varchar(110) NOT NULL,
 user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE pages (   -- estatic users 
id serial PRIMARY KEY,
section_id int REFERENCES sections(id),
title varchar(180) NOT NULL,
body text NOT NULL,
created timestamp(0) with time zone DEFAULT now() NOT NULL,
updated timestamp(0) with time zone DEFAULT now() NOT NULL,
discution int NOT NULL DEFAULT 1,  -- 1= comentarios activados   0 = no activados
display int NOT NULL DEFAULT 1,    -- EL cintillo
status int NOT NULL DEFAULT 0,     -- 0 = draft, 1 = publicado
visits int NOT NULL DEFAULT 0,
rank int NOT NULL DEFAULT 0,
user_id int NOT NULL REFERENCES users (id),
cv int NOT NULL DEFAULT 0,  -- mostrar cv del usuario en la pogina = 1
editor int NOT NULL DEFAULT 1
);

--Entries users weblogs
CREATE TABLE entries (
   id serial PRIMARY KEY,
   title varchar(250) NOT NULL,
   body text NOT NULL,
   themeblog_id int NOT NULL REFERENCES themeblogs(id),
   created timestamp(0) with time zone NOT NULL DEFAULT now(),
   status int NOT NULL DEFAULT 0,
   user_id int NOT NULL REFERENCES users(id),
   discution int NOT NULL DEFAULT 1,   -- Discution on entry, Actived/Desactived   1/0
   tags varchar(100),
   visits int NOT NULL DEFAULT 0 
);

-- Discutions on static 
CREATE TABLE discutions (    --discutions on 
 id serial PRIMARY KEY,
 comment text,
 level int NOT NULL,
 discution_id int NOT NULL,
 username varchar(20) NOT NULL DEFAULT '',
 user_id int NOT NULL,
 page_id int NOT NULL REFERENCES pages(id) ON DELETE CASCADE,
 "created" timestamp(0) with time zone DEFAULT now() NOT NULL
);

-- Name: polls; Type: TABLE; Schema: public; Owner: www-data; Tablespace: 
CREATE TABLE polls (
    id serial PRIMARY KEY,
    question varchar(130) NOT NULL,
    created timestamp(0) with time zone DEFAULT now() NOT NULL,
    user_id integer NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    status integer DEFAULT 0 NOT NULL,
    comments boolean NOT NULL DEFAULT True 
);

CREATE TABLE polls_comments ( -- comments on poll
id serial PRIMARY KEY,
poll_id int NOT NULL REFERENCES polls(id) ON DELETE CASCADE,
comment text NOT NULL,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
created timestamp(0) with time zone DEFAULT now() NOT NULL
);


-- Name: pollrows; Type: TABLE; Schema: public; Owner: www-data; Tablespace: 
CREATE TABLE pollrows (
    id serial PRIMARY KEY,
    poll_id integer NOT NULL REFERENCES polls(id) ON DELETE CASCADE,
    answer varchar(130) NOT NULL,
    color varchar(15) DEFAULT 'green' NOT NULL,
    vote integer DEFAULT 0 NOT NULL
);


-- Discutions on blogs entries
CREATE TABLE comentblogs (    --las discusiones en los blogs
 "id" serial PRIMARY KEY,
 "coment" text,
 "entry_id" int NOT NULL REFERENCES entries(id) ON DELETE CASCADE,
 "username" varchar(25) NOT NULL,
 "email" varchar(50),
 "website" varchar(250),
 "created" timestamp(0) with time zone DEFAULT now() NOT NULL,
 "user_id" int NOT NULL DEFAULT 0
);

-- Discutions on news
CREATE TABLE comentnews (  --discutions on news
 id serial PRIMARY KEY,
 new_id int NOT NULL REFERENCES news(id) ON DELETE CASCADE,
 name varchar(100),
 comment text NOT NULL,
 "created" timestamp(0) with time zone DEFAULT now() NOT NULL,
 level int NOT NULL,
 comentnew_id int NOT NULL,
 user_id int NOT NULL,
 status int NOT NULL DEFAULT 1,
 spam int NOT NULL DEFAULT 0
);

CREATE TABLE news_votes (  
id serial PRIMARY KEY,
new_id int NOT NULL REFERENCES news(id) ON DELETE CASCADE,
vote smallint NOT NULL,
user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE commentpolls (  --discutions on polls
 id serial PRIMARY KEY,
 poll_id int NOT NULL REFERENCES polls(id) ON DELETE CASCADE,
 name varchar(100),
 comment text NOT NULL,
 "created" timestamp(0) with time zone DEFAULT now() NOT NULL,
 level int NOT NULL,
 comentnew_id int NOT NULL,
 user_id int NOT NULL,
 status int NOT NULL DEFAULT 1
);

--Gallerys
CREATE TABLE galleries (
 id serial PRIMARY KEY,
 title varchar(90),
 description varchar(150),
 status int NOT NULL DEFAULT 1,
 user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- photos inside gallery
CREATE TABLE photos (
   id serial PRIMARY KEY,
   gallery_id int REFERENCES galleries(id) ON DELETE CASCADE,  -- Gallery
   file varchar(30) NOT NULL UNIQUE,
   title varchar(30),
   text varchar(100),
   "created" timestamp(0) with time zone DEFAULT now() NOT NULL,
   user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- Comment in photograph
CREATE TABLE comentphotos (    --las discusiones en los blogs
 "id" serial PRIMARY KEY,
 "coment" text,
 "photo_id" int NOT NULL REFERENCES photos(id) ON DELETE CASCADE,
 "username" varchar(25) NOT NULL,
 "email" varchar(50),
 "website" varchar(250),
 "created" timestamp(0) with time zone DEFAULT now() NOT NULL,
 "user_id" int NOT NULL DEFAULT 0
);

--  Banners 
CREATE TABLE banners (
 "id" serial PRIMARY KEY,
 "img" varchar(30) NOT NULL,
 "link" varchar(300) NOT NULL,
 "tooltip" varchar(90)
);

-- Imagenes de los users
CREATE TABLE images (
   id serial PRIMARY KEY,
   file varchar(40) NOT NULL UNIQUE,
   user_id int NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- remembers
CREATE TABLE remember (
   id serial PRIMARY KEY,
   subject varchar(80),
   body varchar(200),
   minute varchar(100),
   hour varchar(100),
   day varchar(100),
   month varchar(50),
   user_id int NOT NULL DEFAULT 1
);

-- this is a temporal table, is used to recover the user passwords
CREATE TABLE recovers (
  id serial PRIMARY KEY,
  user_id int REFERENCES users(id) ON DELETE CASCADE,
  random varchar(150) NOT NULL,
  created timestamp(0) with time zone NOT NULL DEFAULT now()
);

CREATE TABLE contacts (
 id serial PRIMARY KEY,
 firstname varchar(40) NOT NULL,
 lastname varchar(40),
 title varchar(6),
 nickname varchar(30),
 email1 varchar(100),
 email2 varchar(100),
 homephone varchar(100),
 workphone varchar(100),
 cellphone varchar(100),
 fax varchar(100),
 cp varchar(10),
 website varchar(250),
 skype varchar(150),
 msn varchar(150),
 address varchar(250),
 organization varchar(100),
 birthday date,
 user_id int REFERENCES users(id) ON DELETE CASCADE
 );

-- workgroups
CREATE TABLE workgroups (
 id serial PRIMARY KEY,
 title varchar(80) NOT NULL,
 description varchar(250),
 user_id int REFERENCES users(id) ON DELETE CASCADE,
 access int NOT NULL DEFAULT 0, -- public/no public
 status int NOT NULL DEFAULT 0, 
 created timestamp(0) with time zone NOT NULL DEFAULT now()
);


-- padawans on courses
CREATE TABLE padawans (
  id serial PRIMARY KEY,
  name varchar(200) NOT NULL,
  email varchar(70) NOT NULL,
  comment text NOT NULL,
  code varchar(8) NOT NULL,
  "user_id" int NOT NULL,
  "status" smallint NOT NULL DEFAULT 0
);

--TODOs from crazylegs 
CREATE TABLE todos (
  "id" serial PRIMARY KEY,
  "user_id" int NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  "name" varchar(80) NOT NULL,
  "task" varchar(255) NOT NULL DEFAULT '',
  "type" varchar(2)  NOT NULL DEFAULT 'L',
  "completed" smallint NOT NULL DEFAULT 0,
  "priority" int NOT NULL DEFAULT 2,
  "created" timestamp(0) with time zone NOT NULL DEFAULT now(),
  "modified" timestamp(0) with time zone NOT NULL DEFAULT now(),
  "deadline" date NOT NULL DEFAULT now() + '1 week'
);
