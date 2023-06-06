------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------


drop table if exists user_playlist cascade;

drop table if exists playlist_song cascade;

drop table if exists playlist cascade;

drop table if exists history cascade;

drop table if exists "user" cascade;

drop table if exists song cascade;

drop table if exists album cascade;

drop table if exists artist cascade;

drop table if exists style_album cascade;

drop table if exists type_artist cascade;

------------------------------------------------------------
-- Table: user
------------------------------------------------------------
CREATE TABLE public.user(
	id_user          SERIAL NOT NULL ,
	name_user        VARCHAR (120) NOT NULL ,
	surname_user     VARCHAR (120) NOT NULL ,
	birthdate_user   DATE  NOT NULL ,
	password_user    VARCHAR (120) NOT NULL ,
	email_user       VARCHAR (120) NOT NULL  ,
	CONSTRAINT user_PK PRIMARY KEY (id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: playlist
------------------------------------------------------------
CREATE TABLE public.playlist(
	id_playlist      SERIAL NOT NULL ,
	name_playlist    VARCHAR (120) NOT NULL ,
	cover_playlist   VARCHAR (480) NOT NULL  ,
	is_fav           BOOL  NOT NULL DEFAULT FALSE,
	CONSTRAINT playlist_PK PRIMARY KEY (id_playlist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: type_artist
------------------------------------------------------------
CREATE TABLE public.type_artist(
	id_type_artist   SERIAL NOT NULL ,
	type_artist      VARCHAR (120) NOT NULL  ,
	CONSTRAINT type_artist_PK PRIMARY KEY (id_type_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: artist
------------------------------------------------------------
CREATE TABLE public.artist(
	id_artist            SERIAL NOT NULL ,
	name_artist          VARCHAR (120) NOT NULL ,
	description_artist   VARCHAR (2000)  NOT NULL ,
	id_type_artist       INT  NOT NULL  ,
	CONSTRAINT artist_PK PRIMARY KEY (id_artist)

	,CONSTRAINT artist_type_artist_FK FOREIGN KEY (id_type_artist) REFERENCES public.type_artist(id_type_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: style_album
------------------------------------------------------------
CREATE TABLE public.style_album(
	id_style_album   SERIAL NOT NULL ,
	style_album      VARCHAR (120) NOT NULL  ,
	CONSTRAINT style_album_PK PRIMARY KEY (id_style_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: album
------------------------------------------------------------
CREATE TABLE public.album(
	id_album         SERIAL NOT NULL ,
	name_album       VARCHAR (120) NOT NULL ,
	date_album       DATE  NOT NULL ,
	cover_album      VARCHAR (480) NOT NULL ,
	id_artist        INT  NOT NULL ,
	id_style_album   INT  NOT NULL  ,
	CONSTRAINT album_PK PRIMARY KEY (id_album)

	,CONSTRAINT album_artist_FK FOREIGN KEY (id_artist) REFERENCES public.artist(id_artist)
	,CONSTRAINT album_style_album0_FK FOREIGN KEY (id_style_album) REFERENCES public.style_album(id_style_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: song
------------------------------------------------------------
CREATE TABLE public.song(
	id_song         SERIAL NOT NULL ,
	title_song      VARCHAR (120) NOT NULL ,
	duration_song   INT  NOT NULL ,
	link_song       VARCHAR (480) NOT NULL ,
	id_album        INT  NOT NULL  ,
	CONSTRAINT song_PK PRIMARY KEY (id_song)

	,CONSTRAINT song_album_FK FOREIGN KEY (id_album) REFERENCES public.album(id_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: user_playlist
------------------------------------------------------------
CREATE TABLE public.user_playlist(
	id_playlist     INT  NOT NULL ,
	id_user         INT  NOT NULL ,
	date_playlist   DATE  NOT NULL  ,
	CONSTRAINT user_playlist_PK PRIMARY KEY (id_playlist,id_user)

	,CONSTRAINT user_playlist_playlist_FK FOREIGN KEY (id_playlist) REFERENCES public.playlist(id_playlist)
	,CONSTRAINT user_playlist_user0_FK FOREIGN KEY (id_user) REFERENCES public.user(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: playlist_song
------------------------------------------------------------
CREATE TABLE public.playlist_song(
	id_playlist              INT  NOT NULL ,
	id_song                  INT  NOT NULL ,
	date_add_song_playlist   DATE  NOT NULL  ,
	CONSTRAINT playlist_song_PK PRIMARY KEY (id_playlist,id_song)

	,CONSTRAINT playlist_song_playlist_FK FOREIGN KEY (id_playlist) REFERENCES public.playlist(id_playlist)
	,CONSTRAINT playlist_song_song0_FK FOREIGN KEY (id_song) REFERENCES public.song(id_song)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: history
------------------------------------------------------------
CREATE TABLE public.history(
	id_song   INT  NOT NULL ,
	id_user   INT  NOT NULL  ,
	date_add_song_history TIMESTAMP ,
	CONSTRAINT history_PK PRIMARY KEY (id_song,id_user)

	,CONSTRAINT history_song_FK FOREIGN KEY (id_song) REFERENCES public.song(id_song)
	,CONSTRAINT history_user0_FK FOREIGN KEY (id_user) REFERENCES public.user(id_user)
)WITHOUT OIDS;
