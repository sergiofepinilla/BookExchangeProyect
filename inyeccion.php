<?php
require_once 'includes/dbh.inc.php';

$editoriales = ["Penguin Random House",
"HarperCollins",
"Simon & Schuster",
"Macmillan Publishers",
"Hachette Livre",
"Wiley",
"Scholastic",
"Pearson Education",
"Bloomsbury Publishing",
"Oxford University Press",
"Cambridge University Press",
"Elsevier",
"Springer",
"McGraw-Hill Education",
"Cengage Learning",
"National Geographic",
"Puffin Books",
"Vintage Books",
"Pantheon Books",
"Grove Press",
"Doubleday",
"Viking Press",
"Farrar, Straus and Giroux",
"Knopf",
"Bantam Books",
"Ballantine Books",
"Avon Books",
"William Morrow",
"Pocket Books",
"St. Martin's Press",
"Grand Central Publishing",
"Little, Brown and Company",
"Penguin Books",
"Picador",
"Anchor Books",
"Scribner",
"Vintage Contemporaries",
"Riverhead Books",
"Harvill Secker",
"Faber and Faber",
"Allen Lane",
"Jonathan Cape",
"Harper Perennial",
"Fourth Estate",
"Bloomsbury",
"Faber & Faber",
"Gollancz",
"Virago Press",
"Canongate Books",
"Transworld Publishers",
"Hodder & Stoughton",
"Orion Publishing Group",
"Quercus",
"Atlantic Books",
"MacLehose Press",
"Sceptre",
"Oneworld Publications",
"Headline Publishing Group",
"Vintage Classics",
"Penguin Classics",
"Norton",
"Harvard University Press",
"Yale University Press",
"University of Chicago Press",
"Princeton University Press",
"MIT Press",
"Columbia University Press",
"HarperOne",
"Zondervan",
"Thomas Nelson",
"Tyndale House",
"Bethany House",
"Moody Publishers",
"WaterBrook",
"Baker Publishing Group",
"Multnomah Books",
"Crossway Books",
"InterVarsity Press",
"NavPress",
"Harlequin",
"Mills & Boon",
"Silhouette",
"Berkley Books",
"Dell Publishing",
"Bantam Dell",
"Ace Books",
"Roc Books",
"Baen Books",
"Tor Books",
"DAW Books",
"St. Martin's Press",
"Orbit Books",
"Gollancz",
"Hodder & Stoughton",
"Angus & Robertson",
"HarperCollins Australia",
"Allen & Unwin",
"Penguin Australia",
"Random House Australia",
"Text Publishing",
"Pan Macmillan Australia",
"Hachette Australia",
"Affirm Press",
"Scribe Publications",
"Black Inc.",
"University of Queensland Press",
"Wakefield Press",
"Fremantle Press",
"Allen & Unwin",
"Penguin Books",
"Simon & Schuster",
"HarperCollins",
"Macmillan Publishers",
"Hachette Book Group",
"Wiley"]; 
$generos = range(1, 26);
$estados = ["nuevo", "usado", "malo"];
$autores = ["George Orwell",
"Gabriel García Márquez",
"Harper Lee",
"Miguel de Cervantes Saavedra",
"James Joyce",
"Jane Austen",
"Marcel Proust",
"F. Scott Fitzgerald",
"J.R.R. Tolkien",
"Ken Follett",
"Mark Twain",
"Paulo Coelho",
"Carlos Ruiz Zafón",
"Dan Brown",
"Homer",
"William Shakespeare",
"Herman Melville",
"Bram Stoker",
"Victor Hugo",
"Franz Kafka",
"Fyodor Dostoevsky",
"Mary Shelley",
"Leo Tolstoy",
"Suzanne Collins",
"Stephen King",
"Oscar Wilde",
"Robert Louis Stevenson",
"Aldous Huxley",
"William Golding",
"Ray Bradbury",
"Stephenie Meyer",
"C.S. Lewis",
"Arthur Conan Doyle",
"Alexandre Dumas",
"Charles Dickens",
"Lewis Carroll",
"Antoine de Saint-Exupéry",
"Jules Verne",
"Agatha Christie",
"Jorge Luis Borges",
"J.K. Rowling",
"Isaac Asimov",
"Virginia Woolf",
"Ernest Hemingway",
"Albert Camus",
"Emily Brontë",
"Hermann Hesse",
"John Steinbeck",
"Jack London",
"Johann Wolfgang von Goethe",
"John Green",
"Mikhail Bulgakov",
"Haruki Murakami",
"Charles Bukowski",
"Edgar Allan Poe",
"Jane Goodall",
"Ayn Rand",
"Toni Morrison",
"Kurt Vonnegut",
"Dante Alighieri",
"Octavio Paz",
"Friedrich Nietzsche",
"Milan Kundera",
"Roald Dahl",
"Joseph Heller",
"Margaret Atwood",
"George R.R. Martin",
"José Saramago",
"Truman Capote",
"John Boyne",
"Federico García Lorca",
"George Bernard Shaw",
"Rainer Maria Rilke",
"Johanna Spyri",
"Walter Scott",
"Yukio Mishima",
"Cormac McCarthy",
"W. Somerset Maugham",
"William Faulkner",
"J.R. Ward",
"Khaled Hosseini",
"John Irving",
"Roald Amundsen",
"Maurice Sendak",
"J.D. Salinger",
"H.P. Lovecraft",
"Mario Vargas Llosa",
"Jodi Picoult",
"Isabel Allende",
"Jung Chang",
"Carlos Fuentes",
"Isabel Wilkerson",
"Chinua Achebe",
"Javier Marías",
"Naguib Mahfouz",
"Edith Wharton",
"Michael Ende",
"Charles Baudelaire",
"Gabriela Mistral",
"Yasunari Kawabata",
"Orhan Pamuk",
"Ernesto Sabato",
"A.A. Milne",
"Italo Calvino",]; // Agrega los autores que desees

$imagenesDirectorio = "imagenes/inyeccion/"; // Ruta al directorio que contiene las imágenes

$titulos = [
    "1984",
"Cien años de soledad",
"Matar a un ruiseñor",
"Don Quijote de la Mancha",
"Ulises",
"Orgullo y prejuicio",
"En busca del tiempo perdido",
"El gran Gatsby",
"Crónica de una muerte anunciada",
"El señor de los anillos",
"Los pilares de la Tierra",
"Las aventuras de Tom Sawyer",
"El alquimista",
"La sombra del viento",
"El código Da Vinci",
"La Odisea",
"Hamlet",
"1984",
"Moby-Dick",
"Romeo y Julieta",
"Drácula",
"Los miserables",
"La metamorfosis",
"Crimen y castigo",
"Frankenstein",
"Orgullo y prejuicio",
"Don Quijote de la Mancha",
"Orgullo y prejuicio",
"Harry Potter y la piedra filosofal",
"El nombre del viento",
"To Kill a Mockingbird",
"The Catcher in the Rye",
"One Hundred Years of Solitude",
"Pride and Prejudice",
"The Great Gatsby",
"Moby-Dick",
"War and Peace",
"Crime and Punishment",
"The Lord of the Rings",
"The Hobbit",
"The Chronicles of Narnia",
"The Hunger Games",
"The Da Vinci Code",
"The Alchemist",
"The Fault in Our Stars",
"Gone Girl",
"The Girl on the Train",
"The Kite Runner",
"The Help",
"The Book Thief",
"The Shining",
"The Picture of Dorian Gray",
"The Odyssey",
"The Adventures of Huckleberry Finn",
"The Grapes of Wrath",
"The Sound and the Fury",
"The Scarlet Letter",
"Jane Eyre",
"Pride and Prejudice",
"Sense and Sensibility",
"Wuthering Heights",
"Mansfield Park",
"David Copperfield",
"Great Expectations",
"Oliver Twist",
"Alice's Adventures in Wonderland",
"The Adventures of Sherlock Holmes",
"The Count of Monte Cristo",
"Les Misérables",
"The Three Musketeers",
"Anna Karenina",
"War and Peace",
"Crime and Punishment",
"The Brothers Karamazov",
"The Picture of Dorian Gray",
"Frankenstein",
"Dracula",
"The Strange Case of Dr. Jekyll and Mr. Hyde",
"Brave New World",
"Lord of the Flies",
"The Catcher in the Rye",
"The Great Gatsby",
"To Kill a Mockingbird",
"Fahrenheit 451",
"1984",
"Animal Farm",
"One Hundred Years of Solitude",
"Love in the Time of Cholera",
"Chronicle of a Death Foretold",
"The Shadow of the Wind",
"The Name of the Rose",
"The Girl with the Dragon Tattoo",
"The Girl Who Played with Fire",
"The Girl Who Kicked the Hornet's Nest",
"The Hobbit",
"The Lord of the Rings",
"The Silmarillion",
"The Children of Húrin",
"The Maze Runner",
"The Hunger Games",
"Catching Fire",
"Mockingjay",
"Divergent",
"Insurgent",
"Allegiant",
"The Fault in Our Stars",
"Gone Girl",
"The Help",
"The Book Thief",
"The Lovely Bones",
"A Game of Thrones",
"A Clash of Kings",
"A Storm of Swords",
"A Feast for Crows",
"A Dance with Dragons",
"Harry Potter and the Philosopher's Stone",
"Harry Potter and the Chamber of Secrets",
"Harry Potter and the Prisoner of Azkaban",
"Harry Potter and the Goblet of Fire",
"Harry Potter and the Order of the Phoenix",
"Harry Potter and the Half-Blood Prince",
"Harry Potter and the Deathly Hallows",
"The Chronicles of Narnia: The Lion, the Witch and the Wardrobe",
"The Chronicles of Narnia: Prince Caspian",
"The Chronicles of Narnia: The Voyage of the Dawn Treader",
"The Chronicles of Narnia: The Silver Chair",
"The Chronicles of Narnia: The Horse and His Boy",
"The Chronicles of Narnia: The Magician's Nephew",
"The Chronicles of Narnia: The Last Battle",
"Twilight",
"New Moon",
"Eclipse",
"Breaking Dawn",
"The Girl with the Dragon Tattoo",
"The Girl Who Played with Fire",
"The Girl Who Kicked the Hornet's Nest",
"The Hunger Games",
"Catching Fire",
"Mockingjay",
"Divergent",
"Insurgent",
"Allegiant",
"The Maze Runner",
"The Scorch Trials",
"The Death Cure",
"The Kill Order",
"The Fault in Our Stars",
"Paper Towns",
"The Maze Runner",
"The Scorch Trials",
"The Death Cure",
"The Kill Order",
"The Fault in Our Stars",
"Paper Towns",
"The Lightning Thief",
"The Sea of Monsters",
"The Titan's Curse",
"The Battle of the Labyrinth",
"The Last Olympian",
"The Lightning Thief",
"The Sea of Monsters",
"The Titan's Curse",
"The Battle of the Labyrinth",
"The Last Olympian",
"The Gunslinger",
"The Drawing of the Three",
"The Waste Lands",
"Wizard and Glass",
"Wolves of the Calla",
"Song of Susannah",
"The Dark Tower",
"The Gunslinger",
"The Drawing of the Three",
"The Waste Lands",
"Wizard and Glass",
"Wolves of the Calla",
"Song of Susannah",
"The Dark Tower",
"The Fellowship of the Ring",
"The Two Towers",
"The Return of the King",
"The Hobbit",
"The Fellowship of the Ring",
"The Two Towers",
"The Return of the King",
"The Silmarillion",
"A Game of Thrones",
"A Clash of Kings",
"A Storm of Swords",
"A Feast for Crows",
"A Dance with Dragons",
"The Witcher: Blood of Elves",
"The Witcher: Time of Contempt",
"The Witcher: Baptism of Fire",
"The Witcher: The Tower of Swallows",
"The Witcher: Lady of the Lake",
"The Witcher: Season of Storms",
"The Name of the Wind",
"The Wise Man's Fear",
"The Slow Regard of Silent Things",
"A Court of Thorns and Roses",
"A Court of Mist and Fury",
"A Court of Wings and Ruin",
"A Court of Frost and Starlight",
"Throne of Glass",
"Crown of Midnight",
"Heir of Fire",
"Queen of Shadows",
"Empire of Storms",
"Tower of Dawn",
"Kingdom of Ash",
"Assassin's Apprentice",
"Royal Assassin",
"Assassin's Quest",
"Ship of Magic",
"The Mad Ship",
"Ship of Destiny",
"Fool's Errand",
"Golden Fool",
"Fool's Fate",
"Dragon Keeper",
"Dragon Haven",
"City of Dragons",
"Blood of Dragons",
"The Eye of the World",
"The Great Hunt",
"The Dragon Reborn",
"The Shadow Rising",
"The Fires of Heaven",
"Lord of Chaos",
"A Crown of Swords",
"The Path of Daggers",
"Winter's Heart",
"Crossroads of Twilight",
"Knife of Dreams",
"The Gathering Storm",
"Towers of Midnight",
"A Memory of Light",
"American Gods",
"Anansi Boys",
"Neverwhere",
"Stardust",
"Coraline",
"The Graveyard Book",
"Norse Mythology",
"Good Omens",
"The Ocean at the End of the Lane",
"American Gods",
"Anansi Boys",
"Neverwhere",
"Stardust",
"Coraline",
"The Graveyard Book",
"Norse Mythology",
"Good Omens",
"The Ocean at the End of the Lane",
"The Blade Itself",
"Before They Are Hanged",
"Last Argument of Kings",
"Best Served Cold",
"The Heroes",
"Red Country",
"A Little Hatred",
"The Trouble with Peace",
"The Fall of Babel",
"Senlin Ascends",
"Arm of the Sphinx",
"The Hod King",
"The Shadow of the Wind",
"The Angel's Game",
"The Prisoner of Heaven",
"The Labyrinth of the Spirits",
"The Name of the Rose",
"Foucault's Pendulum",
"Baudolino",
"The Prague Cemetery",
"The Master and Margarita",
"One Hundred Years of Solitude",
"Love in the Time of Cholera",
"Chronicle of a Death Foretold",
"Of Love and Other Demons",
"The General in His Labyrinth",
"The Autumn of the Patriarch",
"The House of the Spirits",
"Daughter of Fortune",
"Portrait in Sepia",
"Zorro",
"In the Time of the Butterflies",
"The Brief Wondrous Life of Oscar Wao",
"The Power of One",
"Tandia",
"April Fool's Day",
"Jessica",
"The Potato Factory",
"Tommo & Hawk",
"Solomon's Song",
"Brother Fish",
"The Four Legendary Kingdoms",
"The Three Secret"
    ];

$descripciones = [
    "Una emocionante historia llena de intriga y suspense.",
"Un viaje épico lleno de aventuras y descubrimientos.",
"Una conmovedora historia de amor y superación.",
"Un relato impactante que te mantendrá en vilo hasta la última página.",
"Una novela fascinante que te transportará a mundos desconocidos.",
"Una historia llena de misterio y secretos ocultos.",
"Una obra maestra de la literatura que no puedes dejar de leer.",
"Una reflexión profunda sobre la vida y la humanidad.",
"Una novela apasionante que te atrapará desde el primer capítulo.",
"Una historia de lucha y valentía que te inspirará.",
"Un relato lleno de giros inesperados y personajes inolvidables.",
"Una novela que te hará reír, llorar y reflexionar sobre el sentido de la vida.",
"Una historia que te mantendrá en vilo hasta el sorprendente desenlace.",
"Un libro que te hará pensar y cuestionar todo lo que creías saber.",
"Una narración cautivadora que te sumergirá en un mundo de fantasía y magia.",
"Una historia emotiva y conmovedora que te tocará el corazón.",
"Un relato lleno de suspense y tensión que te dejará sin aliento.",
"Una novela que aborda temas universales de una manera original y sorprendente.",
"Una obra literaria que cambiará tu forma de ver el mundo.",
"Una historia de amor y pérdida que te hará reflexionar sobre lo que realmente importa.",
"Un viaje al pasado que te transportará a épocas pasadas llenas de intrigas y conspiraciones.",
"Una novela que combina acción, aventura y romance de una manera única.",
"Un relato que te adentrará en la mente de sus personajes y te hará cuestionar la realidad.",
"Una historia que te hará reír, llorar y experimentar una montaña rusa de emociones.",
"Un libro que te mantendrá en vilo con sus giros inesperados y su ritmo trepidante.",
"Una novela que aborda temas sociales y políticos de manera inteligente y provocadora.",
"Un relato que te hará reflexionar sobre la condición humana y los dilemas éticos.",
"Una historia de amistad y lealtad que te llegará al corazón.",
"Un emocionante viaje a través del tiempo y el espacio.",
"Una historia llena de suspenso y giros inesperados.",
"Una emocionante aventura llena de peligros y desafíos.",
"Un relato fascinante que te hará reflexionar sobre la vida.",
"Una historia de amor prohibido y pasión desenfrenada.",
"Una novela llena de intriga y misterio que te mantendrá en vilo.",
"Una obra maestra de la literatura que no puedes dejar de leer.",
"Un viaje por diferentes culturas y tradiciones del mundo.",
"Una historia con personajes entrañables y momentos emotivos.",
"Un relato épico de valentía y heroísmo en tiempos de guerra.",
"Una novela que te transportará a lugares exóticos y mágicos.",
"Una historia de redención y perdón que tocará tu corazón.",
"Un libro que te hará reflexionar sobre la naturaleza humana.",
"Una trama llena de intrigas políticas y conspiraciones.",
"Una narración envolvente que te atrapará desde la primera página.",
"Una historia llena de humor y momentos divertidos.",
"Un relato que te hará cuestionar la realidad y la percepción.",
"Una novela que te hará reír, llorar y emocionarte.",
"Un viaje al pasado que revela secretos ocultos del presente.",
"Una historia de superación y lucha contra los obstáculos.",
"Un libro que explora los límites de la imaginación y la creatividad.",
"Una novela que aborda temas sociales y culturales de manera profunda.",
"Un relato lleno de sorpresas y revelaciones impactantes.",
"Una historia que te hará pensar en el significado de la vida.",
"Un libro que te sumerge en un mundo de fantasía y magia.",
"Una novela llena de suspense y tensión que no podrás soltar.",
"Un relato que te transporta a épocas pasadas llenas de intrigas.",
"Una historia de amor y amistad que perdura a través del tiempo.",
"Un libro que desafía las convenciones y rompe los moldes literarios.",
"Una novela que te hará reflexionar sobre la naturaleza humana."
];

function generateRandomISBN($length)
{
    $digits = "1234567890";
    $isbn = "";
    for ($i = 0; $i < $length; $i++) {
        $isbn .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $isbn;
}

function generateRandomPrice()
{
    return rand(10, 100); // Ajusta el rango de precios según tus necesidades
}

function generateRandomBoolean()
{
    return rand(0, 1);
}

$maxBooks = 200; // Máximo de libros a insertar
$insertedBooks = 0; // Contador de libros insertados

$carpetaImagenes = "imagenes/inyeccion/IMG/";
$imagenes = glob($carpetaImagenes . "*.jpg");

$conn = Connection::getConnection();
$usuarios = [4, 9, 10, 24, 25, 26, 27, 28];

foreach ($titulos as $titulo) {
    if ($insertedBooks >= $maxBooks) {
        break; // Salir del bucle si se ha alcanzado el límite de libros
    }
    
    $usuario = $usuarios[array_rand($usuarios)];

    $isbn = generateRandomISBN(10); // ISBN de 10 dígitos
    $editorial = $editoriales[array_rand($editoriales)];
    $genero = $generos[array_rand($generos)];
    $estado = $estados[array_rand($estados)];
    $precio = generateRandomPrice();
    $cambio = generateRandomBoolean();
    $envio = generateRandomBoolean();
    $descripcion = $descripciones[array_rand($descripciones)];
    $indiceAleatorio = array_rand($imagenes);
    $rutaImagenAleatoria = $imagenes[$indiceAleatorio];
    $imagen = file_get_contents($rutaImagenAleatoria);
    $autor = $autores[array_rand($autores)];
    $tituloEscaped = mysqli_real_escape_string($conn, $titulo);
    $editorialEscaped = mysqli_real_escape_string($conn, $editorial);

    $query = "INSERT INTO libros_venta (id_usuario, titulo, isbn, editorial, genero, estado, precio, cambio, envio, descripcion, imagen, autor)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssisdiisss", $usuario, $tituloEscaped, $isbn, $editorialEscaped, $genero, $estado, $precio, $cambio, $envio, $descripcion, $imagen, $autor);
    $result = $stmt->execute();

    if ($result) {
        $insertedBooks++;
    } else {
        echo "Error al insertar el libro: " . $stmt->error;
    }
}

echo "Se han insertado $insertedBooks libros.";

$conn->close();
?>