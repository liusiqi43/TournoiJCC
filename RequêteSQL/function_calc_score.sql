

CREATE OR REPLACE FUNCTION get_matches_infos(INOUT year int, INOUT login varchar, INOUT nick varchar, OUT win int, OUT lose int, OUT total int) AS $$
    BEGIN
        SELECT count(*) INTO win
        FROM tmatchs tm, tparticipations tp
        WHERE ((tm.j1 = tp.login AND tp.login = login) OR (tm.j2 = tp.login AND tp.login = login))
        AND tp.annee = tm.annee_tournoi
        AND tp.annee = year AND tm.j1!=tm.j2
        AND ((tm.j1 = login AND tm.victoire = 1) OR (tm.j2 = login AND tm.victoire = 2));

        SELECT count(*) INTO lose
        FROM tmatchs tm, tparticipations tp
        WHERE ((tm.j1 = tp.login AND tp.login = login) OR (tm.j2 = tp.login AND tp.login = login))
        AND tp.annee = tm.annee_tournoi
        AND tp.annee = year AND tm.j1!=tm.j2
        AND ((tm.j1 = login AND tm.victoire = 2) OR (tm.j2 = login AND tm.victoire = 1));

        SELECT count(*) INTO total
        FROM tmatchs tm, tparticipations tp
        WHERE ((tm.j1 = tp.login AND tp.login = login) OR (tm.j2 = tp.login AND tp.login = login))
        AND tp.annee = tm.annee_tournoi
        AND tp.annee = year AND tm.j1!=tm.j2
        AND (tm.j1 = login OR tm.j2 = login);

    END;
$$ LANGUAGE plpgsql;
