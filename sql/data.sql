/* Ajout d'utilisateurs */

INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Sermon-Thuillier', 'Goustan', '2002-11-12', crypt('gou', gen_salt('md5')) , 'goustan.sermon-thuillier@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Paul', 'Fontaine', '2003-06-03', crypt('paul', gen_salt('md5')) , 'paul.fontaine@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Paitier', 'Mathias', '2003-05-12', crypt('mat', gen_salt('md5')) , 'mathias.paitier@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Le Goff', 'Quentin', '2003-02-28', crypt('que', gen_salt('md5')) , 'quentin.legoff@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Le Boulch', 'Antoine', '2003-08-01', crypt('ant', gen_salt('md5')) , 'antoine.leboulch@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Le Pan', 'Ethan', '2003-02-28', crypt('eth', gen_salt('md5')) , 'ethan.lepan@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Kebci', 'Paul', '2003-03-19', crypt('pau', gen_salt('md5')) , 'paul.kebci@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Croguennoc', 'Romain', '2003-10-03', crypt('rom', gen_salt('md5')) , 'romain.croguennoc@isen.fr');
INSERT INTO "user"(surname_user, name_user, birthdate_user, password_user, email_user) values ('Porodo', 'Théo', '2002-04-06', crypt('the', gen_salt('md5')) , 'theo.porodo@isen.fr');

/* Création des types d'artiste */

INSERT INTO type_artist(type_artist) values ('Groupe');
INSERT INTO type_artist(type_artist) values ('Chanteur');

/* Création des styles d'album */

INSERT INTO style_album(style_album) values ('Rock');  /* 1 */
INSERT INTO style_album(style_album) values ('Pop');  /* 2 */
INSERT INTO style_album(style_album) values ('Rap');  /* 3 */
INSERT INTO style_album(style_album) values ('Classique'); /* 4 */
INSERT INTO style_album(style_album) values ('Jazz'); /* 5 */
INSERT INTO style_album(style_album) values ('Electro'); /* 6 */
INSERT INTO style_album(style_album) values ('RnB'); /* 7 */
INSERT INTO style_album(style_album) values ('Reggae'); /* 8 */
INSERT INTO style_album(style_album) values ('Country'); /* 9 */
INSERT INTO style_album(style_album) values ('Funk'); /* 10 */
INSERT INTO style_album(style_album) values ('Soul'); /* 11 */
INSERT INTO style_album(style_album) values ('Disco'); /* 12 */
INSERT INTO style_album(style_album) values ('Blues'); /* 13 */
INSERT INTO style_album(style_album) values ('Metal'); /* 14 */
INSERT INTO style_album(style_album) values ('Folk'); /* 15 */
INSERT INTO style_album(style_album) values ('Punk'); /* 16 */
INSERT INTO style_album(style_album) values ('Gospel'); /* 17 */
INSERT INTO style_album(style_album) values ('J-Pop'); /* 18 */
INSERT INTO style_album(style_album) values ('Chanson Française'); /* 19 */
INSERT INTO style_album(style_album) values ('Autre'); /* 20 */

/* Création des artistes */

INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Patrick Sébastien ', 2, 'Description'); /* 1 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Johnny Hallyday', 2, 'Description'); /* 2 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Michel Sardou', 2, 'Description'); /* 3 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Jean-Jacques Goldman', 2, 'Description'); /* 4 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Sexion dassaut', 1, 'Description'); /* 5 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Maitre Gims', 2, 'Description'); /* 6 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Booba', 2, 'Description'); /* 7 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Ado', 2, 'Description'); /* 8 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Eve', 2, 'Description'); /* 9 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Aya Nakamura', 2, 'Description'); /* 10 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('The Beatles', 1, 'Description'); /* 11 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Earth Wind and Fire', 1, 'Description'); /* 12 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('King Crimson', 1, 'Description'); /* 13 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Michel Polnareff', 2, 'Description'); /* 14 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Daniel Balavoine', 1, 'Description'); /* 15 */
INSERT INTO artist(name_artist, id_type_artist, description_artist) values ('Haddaway', 1, 'Description'); /* 16 */


/* Création des albums */

INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Putain, c est génial', '2023-04-28', 'https://m.media-amazon.com/images/I/811TIdiWG6L._UF894,1000_QL80_.jpg', 1, 19); /* 1 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Même pas peur', '2009-11-09', 'https://m.media-amazon.com/images/I/51-YfI2Q8WL._UF894,1000_QL80_.jpg', 1, 19); /* 2 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Mon pays cest l amour', '2018-10-19', 'https://static.fnac-static.com/multimedia/Images/FR/NR/d9/45/a0/10503641/1540-1/tsp20180920110115/Mon-pays-c-est-l-amour.jpg', 2, 1); /* 3 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Jhabite en France', '1970-10-01', 'https://m.media-amazon.com/images/I/719QLMPsYOL._SL1400_.jpg', 3, 19); /* 4 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Positif', '1984-10-01', 'https://m.media-amazon.com/images/I/71ghlGA+GLL._SX355_.jpg', 4, 19); /* 5 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Lécole des points vitaux', '2010-03-29', 'https://www.abcdrduson.com/wp-content/uploads/2014/07/sexion-dassaut-le%CC%81cole-des-points-vitaux.jpg', 5, 3); /* 6 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Subliminal', '2013-05-20', 'https://upload.wikimedia.org/wikipedia/en/thumb/0/08/La-face-cachee-by-Maitre-Gims.jpg/220px-La-face-cachee-by-Maitre-Gims.jpg', 6, 3); /* 7 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Futur', '2012-11-26', 'https://www.abcdrduson.com/wp-content/uploads/2014/07/booba-futur.jpg', 7, 3); /* 8 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Kyōgen', '2022-01-26', 'https://upload.wikimedia.org/wikipedia/en/thumb/8/81/Ado_-_Kyougen.png/220px-Ado_-_Kyougen.png', 8, 18); /* 9 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Bunka', '2017-12-13', 'https://static.qobuz.com/images/covers/ab/si/jxjhtpwywsiab_600.jpg', 9, 18); /* 10 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Nakamura', '2018-11-02', 'https://static.fnac-static.com/multimedia/Images/FR/NR/bf/c7/a0/10536895/1540-1/tsp20181009141310/Album-2018.jpg', 10, 7); /* 11 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Abbey Road', '1969-09-26', 'https://m.media-amazon.com/images/I/91YlTtiGi0L._SY355_.jpg', 11, 1); /* 12 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('I Am', '1979-06-09', 'https://upload.wikimedia.org/wikipedia/en/f/fb/IAmAlbumCover.jpg', 12, 12); /* 13 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('In the Court of the Crimson King', '1969-10-10', 'https://m.media-amazon.com/images/I/71FM257lYjL._UF894,1000_QL80_.jpg', 13, 1); /* 14 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Polnarévolution', '1972-11-02', 'https://m.media-amazon.com/images/I/81+eUSFAbwL._UF894,1000_QL80_.jpg', 14, 1); /* 15 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('Sauver l amour', '1985-10-14', 'https://p5.storage.canalblog.com/58/32/636073/125759783_o.jpg', 15, 19); /* 16 */
INSERT INTO album(name_album, date_album, cover_album, id_artist, id_style_album) values ('The Album - 2nd Edition', '1993-05-07', 'https://m.media-amazon.com/images/I/51IdGIXWx6L._UXNaN_FMjpg_QL85_.jpg', 16, 3); /* 17 */

/* Création des chansons */

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Putain, cest génial', '208', 'https://www.youtube.com/watch?v=wiS3GgVluaI', 1);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Tavernier', '214', 'https://www.youtube.com/watch?v=VhE6vVlcPtg', 1); 
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Chtarboxe rap', '325', 'https://www.youtube.com/watch?v=YDwmaV87wZQ', 1); 
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Tatoof', '211', 'https://www.youtube.com/watch?v=ZeIEJvRyDqU', 1); 

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Même pas peur', '208', 'https://www.youtube.com/watch?v=tEdDg-a4qhk', 2); 
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Samba Do Brasil', '263', 'https://www.youtube.com/watch?v=-a5Ts4otwps', 2); 

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Mon pays cest l amour', '163', 'https://www.youtube.com/watch?v=x1qagp70MEk', 3);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('4m2','184','https://www.youtube.com/watch?v=Kxbjb0ZILiM',3);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Jhabite en France','169','https://www.youtube.com/watch?v=pOvxTYiDaAE',4);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Les bals populaires','187','https://www.youtube.com/watch?v=9AkXfk4M0pw',4);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Envole-moi','309','https://www.youtube.com/watch?v=My41opLFT7M',5);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Wati by Night','249','https://www.youtube.com/watch?v=zD80w-mPrKw',6);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Bella','242','https://www.youtube.com/watch?v=AFg79G2Y8A0',7);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Kalash','230','https://www.youtube.com/watch?v=pH7OTtQb4m0',8);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Readymade','243','https://www.youtube.com/watch?v=jg09lNupc1s',9);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Usseewa','203','https://www.youtube.com/watch?v=Qp3b-RXtz4w',9);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Anoko Secret','237','https://www.youtube.com/watch?v=sgdPlDG1-8k',10);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Dramaturgy','246','https://www.youtube.com/watch?v=jJzw1h5CR-I',10);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Djadja','175','https://www.youtube.com/watch?v=iPGgnzc34tY',11);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Pookie','182','https://www.youtube.com/watch?v=_bPa-VG0AWo',11);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Copines','178','https://www.youtube.com/watch?v=EkGiGf8utCM',11);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Here Comes The Sun','185','https://www.youtube.com/watch?v=GKdl-GCsNJ0',12);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Boogie Wonderland ','289','https://www.youtube.com/watch?v=PbpIyn70t8c',13);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('I Talk To The Wind','366','https://www.youtube.com/watch?v=sjq298rlLWQ',14);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('On ira tous au paradis','275','https://www.youtube.com/watch?v=ZwB4iQ7IJ7E',15);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Aimer est plus fort que d etre aimé','246','https://www.youtube.com/watch?v=3Pwd24iBu5o',16);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('Tous les cris les S.O.S','306','https://www.youtube.com/watch?v=urWV2OjAmUQ',16);
INSERT INTO song(title_song, duration_song, link_song, id_album) values ('L Aziza','261','https://www.youtube.com/watch?v=lHjJlSq3BhA',16);

INSERT INTO song(title_song, duration_song, link_song, id_album) values ('What is love','251','../client/audio/Haddaway - What Is Love (slowed).mp3',17);

/* Création de playlists */
/* Titres likes */
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);
INSERT INTO playlist(name_playlist, cover_playlist, is_fav) values ('Titres likés', 'https://i1.sndcdn.com/artworks-y6qitUuZoS6y8LQo-5s2pPA-t500x500.jpg', true);


/* Autres playlists */
INSERT INTO playlist(name_playlist, cover_playlist) values ('La liste qui joue', 'https://wallpapercave.com/wp/wp11216531.jpg');
INSERT INTO playlist(name_playlist, cover_playlist) values ('Playlist ROOOCK !!!', 'https://pro2-bar-s3-cdn-cf4.myportfolio.com/dbea3cc43adf643e2aac2f1cbb9ed2f0/f14d6fc4-2cea-41a2-9724-a7e5dff027e8_rw_1200.jpg?h=60e8fb45f75e1a2612c53a4f2174997c');
INSERT INTO playlist(name_playlist, cover_playlist) values ('Playlist de Quentin', 'https://mir-s3-cdn-cf.behance.net/project_modules/hd/602f4731226337.5646928c3633f.jpg');
INSERT INTO playlist(name_playlist, cover_playlist) values ('Playlist de Antoine', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg');

/* Ajout de musiques dans la playlist via playlist_song */

INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 1, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 2, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 4, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 6, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 9, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 10, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 12, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 13, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 14, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 15, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 18, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 19, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (10, 23, '2023-02-06');

INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (11, 7, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (11, 8, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (11, 22, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (11, 24, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (11, 25, '2023-02-06');

INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (12, 9, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (12, 10, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (12, 11, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (12, 12, '2023-02-06');
INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) values (12, 13, '2023-02-06');

/* On lie les playlists aux utilisateurs via user_playlist */
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (1, 1, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (2, 2, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (3, 3, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (4, 4, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (5, 5, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (6, 6, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (7, 7, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (8, 8, '2023-02-03');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (9, 9, '2023-02-03');

INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (1, 10, '2023-02-06');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (7, 11, '2023-02-06');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (4, 12, '2023-02-06');
INSERT INTO user_playlist(id_user, id_playlist, date_playlist) values (5, 13, '2023-06-04');