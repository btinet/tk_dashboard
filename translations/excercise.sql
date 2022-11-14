-- a)
SELECT bez AS Artikel, SUM(stueck) AS Anzahl FROM artikel GROUP BY bez;

-- b)
SELECT bez AS Artikel, material AS Material, SUM(stueck) AS Anzahl FROM artikel GROUP BY bez, material;

-- c)
SELECT bez AS Artikel, SUM(stueck) AS Anzahl FROM artikel WHERE stueck >= 1000 GROUP BY bez;

-- d)
-- d1
SELECT material AS "Artikel nach Matieral", SUM(stueck) AS Anzahl FROM artikel WHERE material ="Plastik";
-- d2
SELECT material AS "Artikel nach Matieral", SUM(stueck) AS Anzahl FROM artikel GROUP BY material;