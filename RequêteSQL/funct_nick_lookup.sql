

CREATE OR REPLACE FUNCTION nickname_lookup(IN year int, IN login varchar, OUT nick varchar) AS $$
    BEGIN
        SELECT surnom INTO nick
        FROM tparticipations tp
        WHERE tp.annee = year AND tp.login = login;
    END;
$$ LANGUAGE plpgsql;
