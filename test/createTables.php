<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="tables.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>

<?php

// If local:
  $servername = "localhost";
  $username = "root";
  $password = "root";

/* If on UoM
  $servername = "dbhost.cs.man.ac.uk";
  $username = "m37064lh";
  $password = "SQLDatabaseP";
*/
  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully" . "<br />";

// -- Only on local
  $sql = "DROP DATABASE Y1";
  if ($conn->query($sql)) {
    echo "DATABASE reset" . "<br />";
  }
  else {
    echo("Error: " . $conn->error . "<br />");
  }

  // Creates the db
  $sql = "CREATE DATABASE Y1";

  if ($conn->query($sql)) {
    echo("Database created successfully" . "<br />");
  }
  else {
    echo("Error: " . $conn->error . "<br />");
  }
//

  $conn->select_db("Y1");
  // if UoM $conn->select_db("2020_comp10120_y1");
  if (!$conn) {
    echo("Error: " . $conn->error . "<br />");
  }

  // Creates login table
  $sql = "
          CREATE TABLE login (
            userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            forename VARCHAR(30) NOT NULL,
            surname VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(256) NOT NULL
            )
  ";

  if ($conn->query($sql)) {
    echo "Login table created successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Creates user table
  $sql = "
          CREATE TABLE user (
            userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY REFERENCES login(userId),
            favourite_recipes TEXT,
            owned_ingredients TEXT,
            flag_list CHAR(7) NOT NULL
            )
  ";

  if ($conn->query($sql)) {
    echo "User table created successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Creates recipe table
  $sql = "
          CREATE TABLE recipes (
            recipeId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            recipe_name VARCHAR(60) NOT NULL,
            image VARCHAR(200) NOT NULL,
            calories SMALLINT NOT NULL,
            fat SMALLINT NOT NULL,
            carbs SMALLINT NOT NULL,
            protein SMALLINT NOT NULL,
            salt FLOAT NOT NULL,
            sugar SMALLINT NOT NULL,
            time SMALLINT NOT NULL,
            difficulty TINYINT,
            ingredients TEXT NOT NULL,
            method TEXT NOT NULL,
            flags CHAR(7) NOT NULL,
            user_rating VARCHAR(10),
            popularity VARCHAR(10)
            )
  ";

  if ($conn->query($sql)) {
    echo "Recipe table created successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Inserting a test user
  $password = password_hash('test', PASSWORD_BCRYPT);
  $sql = "INSERT INTO login (forename, surname, email, password)
            VALUES ('Lawrence', 'Hunter', 'lh@lh.com', '$password')";
  if ($conn->query($sql)) {
    echo "Login added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Inserting a test user
  $sql = "INSERT INTO user (favourite_recipes, owned_ingredients, flag_list)
            VALUES ('Test: favourite_recipes', 'Test: owned_ingredients', '0000100')";
  if ($conn->query($sql)) {
    echo "User added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Ve V N H G E D

  //Inserting test1 recipe
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('test gluten free', 'db_images/test1.jpeg',
          100, 2, 30, 10, 0.2, 10, 30, 2, 'Test ingredients', 'Test method',
          '0000100', '4.1~0', '9.8~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting test2 recipe
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('test halal', 'db_images/test2.jpeg',
          30, 20, 3, 100, 0.2, 10, 30, 2, 'Test ingredients', 'Test method',
          '0001000', '4.1~0', '9.8~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }
  //Inserting a test recipe: doughnuts
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Jam doughnuts', 'db_images/doughnut.webp',
          233, 9, 32, 5, 0.6, 13, 85, 3, '500g Strong white bread flour~ 60g Golden caster sugar~
                                          15g Fresh yeast~ 4 Medium eggs~ 0.5 Lemon~ 2tsp Sea salt
                                          125g Softened unsalted butter~ 2 litres Sunflower oil~
                                          Caster sugar - for tossing~ 300g Jam', 'Put 150g water and all the dough ingredients, apart from the butter, into the bowl of a mixer with a beater paddle. Mix on a medium speed for 8 mins or until the dough starts coming away from the sides and forms a ball. Turn off the mixer and let the dough rest for 1 min.~
                                          Start the mixer up again on a medium speed and slowly add the butter to the dough – about 25g at a time. Once it\'s all incorporated, mix on high speed for 5 mins until the dough is glossy, smooth and very elastic when pulled.~
                                          Cover the bowl with cling film or a clean tea towel and leave to prove until it\'s doubled in size. Knock back the dough in the bowl briefly, then re-cover and put in the fridge to chill overnight.~
                                          The next day, take the dough out of the fridge and cut it into 50g pieces (you should get about 20).~
                                          Roll the dough pieces into smooth, tight buns and place them on a floured baking tray, leaving plenty of room between them, as you don’t want them to stick together while they prove.~
                                          Cover loosely with cling film and leave for 4 hrs or until doubled in size. Fill your deep-fat fryer or heavy-based saucepan halfway with oil. Heat the oil to 180C.~
                                          When the oil is heated, carefully slide the doughnuts from the tray using a floured pastry scraper. Taking care not to deflate them, put them into the oil. Do 2-3 per batch, depending on the size of your fryer or pan.~
                                          Fry for 2 mins each side until golden brown – they puff up and float, so you may need to gently push them down after about 1 min to help them colour evenly.~
                                          Remove the doughnuts from the fryer and place them on kitchen paper.~
                                          Toss the doughnuts in a bowl of caster sugar while still warm. Repeat the steps until all the doughnuts are fried, but keep checking the oil temperature is correct – if it\'s too high, they will burn and be raw in the middle; if it\'s too low, the oil will be absorbed into the doughnuts and they will become greasy. Set aside to cool before filling.~
                                          To fill the doughnuts, make a hole with a small knife in the crease of each one, anywhere around the white line between the fried top and bottom.~',
          '0011000', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Sticky Chinese chicken traybake
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Sticky Chinese chicken traybake', 'db_images/sticky-chinese-chicken-traybake.webp',
          450, 27, 19, 32, 1, 14, 50, 1, '8 Chicken thighs~ 4tbsp Hoisin sauce~
                                          2tsp Sesame oil~ 2tbsp Clear honey~ 1.5tsp Chinese five-spice powder~ Thumb size piece of ginger, grated~
                                          2 Garlic cloves~ Bunch of spring onions~
                                          50g Cashew nuts, toasted~ Cooked brown rice, to serve', 'Heat oven to 200C/180C fan/gas 6. Arrange the chicken thighs in a large roasting tin and slash the skin 2-3 times on each thigh. Mix together the hoisin, sesame oil, honey, five-spice, ginger, garlic and some seasoning. Pour over the chicken and toss to coat – you could now marinate the chicken for 2 hrs, or overnight if you have time. Roast, skin-side up, for 35 mins, basting at least once.~
                                          Stir through the cashew nuts and sprinkle the spring onions over the chicken. Return to the oven for 5 mins, then serve with brown rice.',
          '0000011', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Sausage ragu
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Sausage ragu', 'db_images/sausage-ragu.webp',
          589, 18, 83, 19, 0.5, 18, 50, 1, '3 tbsp olive oil~ 1 onion, finely chopped~
                                          2 large Garlic cloves, crushed~ 0.25 tsp Chilli flakes~ 2 rosemary sprigs, leaves finely chopped~ 2 x 400g cans Chopped tomatoes~
                                          1 tbsp brown sugar~ 6 pork sausages~
                                          150ml whole milk~ 1 lemon, zested~ 350g rigatoni pasta~ grated parmesan', 'Heat 2 tbsp of the oil in a saucepan over a medium heat. Fry the onion with a pinch of salt for 7 mins. Add the garlic, chilli and rosemary, and cook for 1 min more. Tip in the tomatoes and sugar, and simmer for 20 mins.~
                                          Heat the remaining oil in a medium frying pan over a medium heat. Squeeze the sausagemeat from the skins and fry, breaking it up with a wooden spoon, for 5-7 mins until golden. Add to the sauce with the milk and lemon zest, then simmer for a further 5 mins.~
                                          Cook the pasta following pack instructions. Drain and toss with the sauce. Scatter over the parmesan and parsley leaves to serve.',
          '0010000', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Rice paper wraps
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Rice paper wraps', 'db_images/rice-paper-wraps.webp',
          125, 5, 15, 5, 0.2, 1, 20, 1, '50g rice vermicelli noodles~ 1 carrot, peeled~
                                          1 avocado, peeled and destoned~ 0.25 cucumber~ 8 rice paper wraps~ 8 king prawns, peeled and cooked~
                                          8 mint leaves~ 0.5 chicken breast, cooked and shredded~
                                          sweet chilli sauce, to serve', 'Put the noodles in a pan of water and bring to the boil, simmer for 3 mins, then cool under running water. Drain thoroughly.~
                                          Cut the carrot into matchsticks using a knife or a mandoline. Cut the avocado into strips and the cucumber into thin sticks. Soak 2 of the rice paper wraps in cold water for 1-2 mins until floppy.~
                                          Lift 1 sheet of rice paper out of the water, shake gently, then lay it carefully on a board. Place 2 prawns in the centre, with a mint leaf between them. Add a strip of avocado, pile some noodles on top, then add a layer of carrot and cucumber. Fold the bottom half of the rice paper over, then fold the sides in and tightly roll it up. Repeat using the second wrapper and soak 2 more to make 2 more rolls.~
                                          Make the rest of the rolls up using the remaining 4 wraps and the shredded chicken instead of prawns. Serve the rolls with the sweet chilli sauce for dipping.',
          '0010011', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Nutty chicken satay strips
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Nutty chicken satay strips', 'db_images/nutty-chicken-sate-strips.webp',
          276, 10, 3, 41, 0.7, 2, 20, 1, '2 tbsp chunky peanut butter~ 1 garlic clove, finely grated~
                                          1 tsp Madras curry powder~ 1 tbsp soy sauce~ 2 tsp lime juice~ 2 skinless, chicken breast fillets cut into thick strips~
                                          About 10cm Cucumber, cut into fingers~
                                          Sweet chilli sauce, to serve', 'Heat oven to 200C/180C fan/gas 4 and line a baking tray with non-stick paper.~
                                          Mix 2 tbsp chunky peanut butter with 1 finely grated garlic clove, 1 tsp Madras curry powder, a few shakes of soy sauce and 2 tsp lime juice in a bowl. Some nut butters are thicker than others, so if necessary, add a dash of boiling water to get a coating consistency.~
                                          Add 2 skinless chicken breast fillets, cut into strips, and mix well. Arrange on the baking sheet, spaced apart, and bake in the oven for 8-10 mins until cooked, but still juicy.~
                                          Eat warm with roughly 10cm cucumber, cut into fingers, and sweet chilli sauce. Alternatively, leave to cool and keep in the fridge for up to 2 days.',
          '0000011', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Vegan chilli
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Vegan chilli', 'db_images/vegan-chilli.webp',
          367, 10, 48, 12, 0.6, 22, 60, 1, '3 tbsp olive oil~ 2 sweet potatoes, peeled and cut into medium chunks~
                                          2 tsp smoked paprika~ 2 tsp ground cumin~ 1 onion, chopped~ 2 carrots, chopped~ 2 celery sticks, chopped~
                                          2 garlic cloves, crushed~ 1-2 tsp chilli powder~ 1 tsp dried oregano~ 1 tbsp tomato purée~ 1 red pepper, cut into chunks~
                                          2 x 400g cans chopped tomatoes~ 400g can black beans, drained~ 400g can kidney beans, drained~ lime wedges, guacamole, rice and coriander to serve',
                                          'Heat the oven to 200C/180C fan/gas 6. Put the sweet potato in a roasting tin and drizzle over 1½ tbsp oil, 1 tsp smoked paprika and 1 tsp ground cumin. Give everything a good mix so that all the chunks are coated in spices, season with salt and pepper, then roast for 25 mins until cooked.~
                                          Meanwhile, heat the remaining oil in a large saucepan over a medium heat. Add the onion, carrot and celery. Cook for 8-10 mins, stirring occasionally until soft, then crush in the garlic and cook for 1 min more. Add the remaining dried spices and tomato purée. Give everything a good mix and cook for 1 min more.~
                                          Add the red pepper, chopped tomatoes and 200ml water. Bring the chilli to a boil, then simmer for 20 mins. Tip in the beans and cook for another 10 mins before adding the sweet potato. Season to taste then serve with lime wedges, guacamole, rice and coriander.',
          '1111111', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }


  //Inserting a test recipe: Spiced halloumi & pineapple burger with zingy slaw
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Spiced halloumi & pineapple burger with zingy slaw', 'db_images/halloumi-burger.webp',
          264, 14, 19, 11, 1.2, 18, 25, 1, '0.5 red cabbage, grated~ 2 carrots, grated~
                                          100g radishes, sliced~ 1 small pack coriander, chopped~ 2 limes, juiced~ 1 tbsp cold-pressed rapeseed oil~ big pinch of chilli flakes~
                                          1 tbsp chipotle paste~ 60g halloumi, cut into 4 slices~ 2 small slices of fresh pineapple~ 1 Little Gem lettuce, divided into 4 lettuce cups, or 2 small seeded burger buns, cut in half, to serve',
                                          'Heat the barbecue. Put the cabbage, carrot, radish and coriander in a bowl. Pour over the lime juice, add ½ tbsp oil and the chilli flakes, then season with salt and pepper. Give everything a good mix with your hands. This can be done a few hours before and kept in the fridge.~
                                          Mix the remaining oil with the chipotle paste then coat the halloumi slices in the mixture. Put the halloumi slices on a sheet of foil and put on the barbecue with the pineapple (or use a searing hot griddle pan if cooking inside). Cook for 2 mins on each side until the cheese is golden, and the pineapple is beginning to caramelise. Brush the buns with the remaining chipotle oil, then put your burger buns, if using, cut-side down, on the barbecue for the last 30 seconds of cooking to toast.~
                                          Assemble your burgers with the lettuce or buns. Start with a handful of the slaw, then add halloumi and pineapple. Serve with the remaining slaw.',
          '0111010', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Vegan lemon cake
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Vegan lemon cake', 'db_images/vegan-lemon-cake.webp',
          276, 9, 47, 2, 0.3, 29, 45, 1, '100ml vegetable oil, plus extra for the tin~ 275g self-raising flour~
                                          200g golden caster sugar~ 1 tsp baking powder~ 1 lemon, zested, 0.5 juiced~ 150g icing sugar~ 0.5 lemon, juiced',
                                          'Heat oven to 200C/180C fan/gas 6. Oil a 1lb loaf tin and line it with baking parchment. Mix the flour, sugar, baking powder and lemon zest in a bowl. Add the oil, lemon juice and 170ml cold water, then mix until smooth.~
                                          Pour the mixture into the tin. Bake for 30 mins or until a skewer comes out clean. Cool in the tin for 10 mins, then remove and transfer the cake to a wire rack to cool fully.~
                                          For the icing, sieve the icing sugar into a bowl. Mix in just enough lemon juice to make an icing thick enough to pour over the loaf (if you make the icing too thin, it will just run off the cake).',
          '1111011', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting a test recipe: Sausage, kale & gnocchi one-pot
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Sausage, kale & gnocchi one-pot', 'db_images/sausage-kale-gnocchi-one-pot.webp',
          516, 27, 44, 21, 2.5, 3, 20, 1, '1 tbsp olive oil~ 6 pork sausages~
                                          1 tsp chilli flakes~ 1 tsp fennel seeds~ 500g fresh gnocchi~ 500ml chicken stock~ 100g chopped kale~ 40g parmesan, finely grated',
                                          'Heat the oil in a large high-sided frying pan over a medium heat. Squeeze the sausages straight from their skins into the pan, then use the back of a wooden spoon to break the meat up. Sprinkle in the chilli flakes and fennel seeds, if using, then fry until the sausagemeat is crisp around the edges. Remove from the pan with a slotted spoon.~
                                          Tip the gnocchi into the pan, fry for a minute or so, then pour in the chicken stock. Once bubbling, cover the pan with a lid and cook for 3 mins, then stir in the kale. Cook for 2 mins more or until the gnocchi is tender and the kale has wilted. Stir in the parmesan, then season with black pepper and scatter the crisp sausagemeat over the top.',
          '0011000', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }


  //Inserting a test recipe: Sausage, kale & gnocchi one-pot
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Breakfast burrito', 'db_images/breakfast-burrito.webp',
          366, 21, 26, 16, 0.9, 4, 15, 1, '1 tsp chipotle paste~ 1 egg~ 1 tsp rapeseed oil~
                                          50g kale~ 7 cherry tomatoes, halved~ 0.5 small avocado, sliced~ 1 wholemeal tortilla wrap, warmed',
                                          'Whisk the chipotle paste with the egg and some seasoning in a jug. Heat the oil in a large frying pan, add the kale and tomatoes.~
                                          Cook until the kale is wilted and the tomatoes have softened, then push everything to the side of the pan. Pour the beaten egg into the cleared half of the pan and scramble. Layer everything into the centre of your wrap, topping with the avocado, then wrap up and eat immediately.', 
          '0111001', '0~0', '0~0')";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }


  $sql = "SELECT * FROM login";
  $records = $conn->query($sql);

  $output = "<table border='2'>
              <th>User ID</th>
              <th>Forename</th>
              <th>Surname</th>
              <th>Email</th>
              <th>Password</th>";

  while ($row = $records->fetch_assoc()) {
    $output .= "<tr>
                  <td>$row[userId]</td>
                  <td>$row[forename]</td>
                  <td>$row[surname]</td>
                  <td>$row[email]</td>
                  <td>$row[password]</td>";
  }
  echo "<h1>Login table</h1>";
  echo $output;

  $sql = "SELECT * FROM user";
  $records = $conn->query($sql);

  $output = "<table border='2'>
              <th>User ID</th>
              <th>Favourite recipes</th>
              <th>Owned ingredients</th>
              <th>Flag list</th>";

  while ($row = $records->fetch_assoc()) {
    $output .= "<tr>
                  <td>$row[userId]</td>
                  <td>$row[favourite_recipes]</td>
                  <td>$row[owned_ingredients]</td>
                  <td>$row[flag_list]</td>";
  }
  echo "<h1>User table</h1>";
  echo $output;


  $sql = "SELECT * FROM recipes";
  $records = $conn->query($sql);
  $output = "<table border='2'>
              <th>Recipe ID</th>
              <th>Recipe name</th>
              <th>Image</th>
              <th>Calories</th>
              <th>Fat</th>
              <th>Carbs</th>
              <th>Protein</th>
              <th>Salt</th>
              <th>Sugar</th>
              <th>Time</th>
              <th>Difficulty</th>
              <th>Ingredients</th>
              <th>Method</th>
              <th>Flags</th>
              <th>User rating</th>
              <th>Popularity</th>";

  while ($row = $records->fetch_assoc()) {
    $output .= "<tr>
                  <td>$row[recipeId]</td>
                  <td>$row[recipe_name]</td>
                  <td>$row[image]</td>
                  <td>$row[calories]</td>
                  <td>$row[fat]</td>
                  <td>$row[carbs]</td>
                  <td>$row[protein]</td>
                  <td>$row[salt]</td>
                  <td>$row[sugar]</td>
                  <td>$row[time]</td>
                  <td>$row[difficulty]</td>
                  <td>$row[ingredients]</td>
                  <td>$row[method]</td>
                  <td>$row[flags]</td>
                  <td>$row[user_rating]</td>
                  <td>$row[popularity]</td>";
  }
  echo "<h1>Recipe table</h1>";
  echo $output;

?>
