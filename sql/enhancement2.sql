
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment)
Values('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, 'I am the real Ironman')

UPDATE clients SET clientLevel=3 WHERE clientFirstname= 'Tony';

UPDATE inventory SET invDescription='Do you have 6 kids and like to go off-roading? The Hummer gives you the spacious interior with an engine to get you out of any muddy or rocky situation.' WHERE invMake='GM';

SELECT inventory.invModel, carclassification.classificationName 
FROM inventory 
INNER JOIN carclassification ON carclassification.classificationId= inventory.classificationId 
WHERE carclassification.classificationName='SUV';

DELETE FROM inventory WHERE invModel='Jeep';

UPDATE FROM inventory SET invImage=CONCAT('/php',invImage) , invThumbnail=CONCAT('/php',invThumbnail);


UPDATE invImage SET= 'newPathtoImagehere' WHERE inId='numberoftheinIDhere';

UPDATE invThumbnail SET= 'newPathtoImagehere' WHERE inId='numberoftheinvIDhere';


(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!',
 '/images/jeep-wrangler.jpg', '/images/jeep-wrangler-tn.jpg',28045.00, 4 ,'Orange', '1 - SUV')

 