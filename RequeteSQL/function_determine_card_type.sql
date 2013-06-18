-- function_determine_card_type


CREATE OR REPLACE FUNCTION function_determine_card_type(IN cnom varchar, OUT ctype text) AS $$
    DECLARE
    BEGIN
    	select tall.type into ctype
    	FROM (	select nom, 'invention' as type from tcartes 
    				intersect 
    		  	select nom, 'invention' as type from tcartesinvention as ti 
    		UNION 
    			select nom, 'effet' as type from tcartes 
    				intersect 
    			select nom, 'effet' as type from tcarteseffet as te 
    		UNION 
    			select nom, 'ressource' as type from tcartes 
    				intersect 
    			select nom, 'ressource' as type from tcartesressource as tr) 
    		as tall where tall.nom = cnom;
    END;
$$ LANGUAGE plpgsql;
