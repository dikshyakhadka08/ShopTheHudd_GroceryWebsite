<!DOCTYPE html>
<html>
<head>
  <title>Navbar with Rounded Text Box</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
  
  <style>

.custom-footer {
      background: linear-gradient(to right, #FFC371, #FF5F6D);
      color: white;
      padding: 20px;
      position: fixed;
      bottom: 0;
      width: 100%;
      animation: slide-up 0.5s ease;
    }

    @keyframes slide-up {
      0% {
        transform: translateY(100%);
      }
      100% {
        transform: translateY(0);
      }
    }
    .navbar {
      background: linear-gradient(to right, #FFC371, #FF5F6D);
    }

    .navbar-brand {
      color: white;
      font-size: 24px;
      font-weight: bold;
      display: flex;
      align-items: center;
    }

    .rounded-box {
      border-radius: 30px;
      background-color: white;
      padding: 10px 20px;
      text-align: center;
      margin-left: auto;
      margin-right: auto;
    }

    .rounded-box h4 {
      margin: 0;
      font-size: 20px;
      color: black;
      font-family: 'Segoe UI', Arial, sans-serif; /* Specify your desired font */
    }

    .carousel {
      width: 100%;
    }

    .card {
        margin-bottom: 20px;
    }

    .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color:thistle;
  z-index: -1;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.card:hover::before {
  opacity: 1;
}
    .headline-card {
      margin-bottom: 20px;
    }

    .headline-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-title {
      color: #FF5F6D;
    }

    .card-text{
        font-size: larger;
    }
    

  </style>
</head>
<body style="background: linear-gradient(to right, #f857a6, #ff5858);">
  <nav class="navbar navbar-expand-md" style="min-height: 110px;">
    <div class="container">
      <a class="navbar-brand mx-auto" href="#">
        <div class="rounded-box" style="width: 400px;height:55px;">
          <h4 class="mb-0" style="font-size: larger;">Cleckhuddersfax News</h4>
        </div>
      </a>
    </div>
  </nav>
  <div class="container-fluid px-1 mt-4">
    <div class="row">
    <div class="col-4">
        <div class="card headline-card">
          <div class="card-body">
            <h5 class="card-title">Headline of the Day</h5>
            <?php
$headlines = [
    "Breaking News: Cleckhuddersfax wins Best Destination Award",
    "Sports Update: Cleckhuddersfax Tigers win Championship",
    "Technology Breakthrough: Cleckhuddersfax-based Startup revolutionizes the industry",
    "Entertainment Buzz: Popular band to perform live in Cleckhuddersfax",
    "Health Update: Cleckhuddersfax introduces wellness program for residents",
    "Business News: Cleckhuddersfax entrepreneurs launch new venture",
    "Education Update: Cleckhuddersfax schools achieve top rankings",
    "Community Event: Cleckhuddersfax hosts annual festival",
    "Travel Advisory: Explore the beauty of Cleckhuddersfax",
    "Cultural Highlights: Cleckhuddersfax art exhibition attracts international attention"
  ];

            $randomHeadlineIndex = array_rand($headlines);
            $randomHeadline = $headlines[$randomHeadlineIndex];
            ?>

            <p class="card-text"><?php echo $randomHeadline; ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="https://cdn.pixabay.com/photo/2016/10/29/12/23/canal-1780547_1280.jpg"  alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="https://cdn.pixabay.com/photo/2020/02/25/04/02/winter-4877876_1280.jpg"  alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="https://cdn.pixabay.com/photo/2019/07/22/08/59/market-4354599_1280.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">News</h5>
            <?php
$newsContents = [
    "Cleckhuddersfax prepares for its annual festival, a highly anticipated event that brings together locals and visitors from far and wide. The festival, spanning over a week, will feature a wide array of activities and attractions for people of all ages. From live music performances by renowned artists to interactive workshops showcasing local crafts and traditions, there will be something for everyone to enjoy. Food enthusiasts can indulge in a diverse range of culinary delights, with street vendors and local restaurants offering delectable dishes from various cuisines. The festival also aims to promote environmental sustainability by incorporating eco-friendly practices such as recycling and using renewable energy sources. Cleckhuddersfax is buzzing with excitement as the community comes together to celebrate its vibrant culture and create lasting memories.",
    "The local community of Cleckhuddersfax has joined hands to support a charitable initiative aimed at improving the lives of underprivileged children. This initiative, driven by compassion and empathy, aims to provide access to quality education, healthcare, and essential resources for children in need. The community has organized various fundraising events, including charity walks, bake sales, and donation drives, to generate funds and raise awareness about the cause. Additionally, volunteers from different walks of life have come forward to offer their time and expertise in mentoring and tutoring children. This collective effort showcases the kindness and generosity that Cleckhuddersfax is known for, as the community stands united in making a positive difference in the lives of these children.",
    "A groundbreaking study conducted by researchers in Cleckhuddersfax has revealed the remarkable benefits of regular exercise for mental health. The study, spanning several years and involving a diverse group of participants, found that engaging in physical activity on a consistent basis has a significant positive impact on mental well-being. Regular exercise not only reduces symptoms of anxiety and depression but also enhances cognitive function and improves overall mood. The findings highlight the importance of incorporating physical activity into daily routines to support mental health and well-being. Cleckhuddersfax residents are encouraged to prioritize their fitness and engage in activities that they enjoy, whether it's jogging in the park, practicing yoga, or joining community sports clubs.",
    "Exciting news for the residents of Cleckhuddersfax as the city announces plans for major infrastructure improvements. The proposed projects aim to enhance the city's transportation system, making it more efficient, accessible, and sustainable. The plans include the development of new bike lanes and pedestrian-friendly pathways, the expansion of public transportation networks, and the implementation of smart traffic management systems. These initiatives are expected to reduce congestion, promote eco-friendly transportation options, and improve overall mobility within the city. Cleckhuddersfax continues to prioritize the well-being of its residents and strives to create a city that is connected, environmentally conscious, and future-ready.",
    "Art enthusiasts in Cleckhuddersfax are in for a treat with an upcoming art exhibition that showcases the works of talented local artists. The exhibition, curated by renowned art experts, will feature a diverse range of artistic styles and mediums, including paintings, sculptures, installations, and mixed media creations. Visitors will have the opportunity to appreciate the creativity and skill of the artists while exploring thought-provoking themes and concepts. The exhibition aims to foster a vibrant art community in Cleckhuddersfax and provide a platform for emerging artists to showcase their talent. Art lovers and collectors are invited to immerse themselves in this captivating display of local artistic expression.",
    "In a significant breakthrough, scientists in Cleckhuddersfax have made a groundbreaking discovery in cancer research. Their findings offer new insights into the mechanisms of cancer development and potential treatment options. The research team, comprised of renowned oncologists and molecular biologists, conducted extensive laboratory experiments and data analysis to unravel key molecular pathways involved in tumor growth. The discovery opens up exciting possibilities for targeted therapies and personalized medicine, offering hope to millions of cancer patients worldwide. Cleckhuddersfax's scientific community continues to push the boundaries of medical research, working towards a future where cancer can be effectively diagnosed and treated.",
    "Education takes center stage as Cleckhuddersfax hosts an innovative education summit, bringing together experts and educators from around the region. The summit aims to explore new approaches to teaching and learning, incorporating cutting-edge technologies and pedagogical strategies. Participants will engage in interactive workshops, panel discussions, and presentations that focus on topics such as personalized learning, STEAM education, and educational equity. The summit also provides a platform for educators to share best practices, collaborate on projects, and network with like-minded professionals. Cleckhuddersfax's commitment to education is evident in its efforts to provide a nurturing and stimulating learning environment for all students.",
    "The green movement gains momentum in Cleckhuddersfax with the expansion of a community garden project. The project, initiated by passionate local residents, aims to promote sustainable practices and encourage community engagement. The garden serves as a gathering place for residents to grow their own organic produce, exchange gardening tips, and foster a sense of belonging. The expansion plans include additional plots, a composting area, and educational workshops on eco-friendly gardening techniques. Cleckhuddersfax's commitment to environmental stewardship is exemplified by this community-driven initiative, which not only enhances the city's green spaces but also fosters a stronger sense of community and environmental consciousness among its residents.",
    "Sports enthusiasts in Cleckhuddersfax are celebrating a remarkable victory by the local sports team in the regional championship. After months of rigorous training and intense competition, the team emerged triumphant, showcasing their exceptional skills and teamwork. The victory not only brings glory to the team but also instills a sense of pride and inspiration within the community. Cleckhuddersfax residents rally behind their local sports teams, showing unwavering support and admiration for their dedication and achievements. This victory serves as a testament to the passion, talent, and sportsmanship that Cleckhuddersfax embodies.",
    "Exciting deals await Cleckhuddersfax residents as the city unveils its deals of the day. Local businesses and retailers are offering exclusive discounts, promotions, and special offers across a wide range of products and services. Whether it's dining at a popular restaurant, shopping for trendy fashion, or indulging in a spa treatment, there's something for everyone. Cleckhuddersfax residents can take advantage of these limited-time deals to save money while enjoying the best that the city has to offer. Stay updated with the deals of the day and make the most of these fantastic opportunities!"
  ];

              $randomnewsContents = $newsContents[array_rand($newsContents)];

              echo "<p class='card-text'>$randomnewsContents</p>";
            ?>
          </div>
        </div>
      </div>
      <div class="col-7">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Entertainment</h5>
            <?php
$entertainmentContents = [
    "Get ready to be mesmerized by the enchanting performance of the Cleckhuddersfax Symphony Orchestra as they showcase a repertoire of classical masterpieces. Led by a renowned conductor and accompanied by talented musicians, the orchestra will transport you to a world of melodic harmony and emotional depth. From the powerful symphonies of Beethoven to the delicate compositions of Mozart, this musical extravaganza promises an unforgettable evening of artistic brilliance.",
    "Laugh your heart out at the hilarious stand-up comedy show featuring the wittiest comedians from around the country. With their razor-sharp wit and impeccable timing, these talented performers will have you in stitches throughout the night. From observational humor to witty one-liners, their comedic genius knows no bounds. Prepare for a night of non-stop laughter, as they tackle everything from everyday life situations to social and cultural commentary. Get ready for an unforgettable comedy experience that will leave you smiling long after the show.",
    "Embark on a cinematic journey with the latest blockbuster movies at the Cleckhuddersfax Film Festival. From gripping dramas that tug at your heartstrings to action-packed thrillers that keep you on the edge of your seat, there's something for every movie lover. Immerse yourself in captivating storytelling, compelling performances, and stunning cinematography. With a diverse selection of films from around the world, this festival celebrates the art of cinema and invites you to explore different genres, cultures, and perspectives.",
    "Experience the magic of live theater with a captivating production of a Broadway musical. From the moment the curtains rise, you'll be transported to a world of music, dance, and storytelling. Talented actors and singers bring iconic characters to life, while dazzling choreography and elaborate sets create an immersive theatrical experience. Whether it's a timeless classic or a contemporary showstopper, these Broadway productions will leave you spellbound, tapping your feet, and singing along to unforgettable tunes.",
    "Indulge your taste buds with a culinary adventure at the Cleckhuddersfax Food and Wine Festival. This gastronomic extravaganza brings together local restaurants, talented chefs, and food enthusiasts to celebrate the region's vibrant culinary scene. From mouthwatering delicacies to innovative fusion dishes, you'll have the opportunity to sample a wide range of flavors and culinary creations. Paired with exquisite wines and craft beverages, this festival promises to tantalize your senses and showcase the rich diversity of Cleckhuddersfax's culinary offerings.",
    "Groove to the beats of talented local musicians at the Cleckhuddersfax Music Festival. From jazz and blues to rock and pop, this festival offers a fantastic lineup of live performances across various genres. Talented bands and solo artists take the stage, captivating the audience with their mesmerizing melodies and infectious rhythms. Whether you're a music aficionado or simply love to dance and sing along, the Cleckhuddersfax Music Festival is a must-attend event that celebrates the power of music and brings the community together.",
    "Step into the realm of artistry at the Cleckhuddersfax Art Expo, where talented painters, sculptors, and artisans display their stunning creations. From breathtaking landscapes to thought-provoking abstract art, the exhibition showcases a diverse range of artistic styles and mediums. Explore the intricate details of each masterpiece, engage with the artists, and gain insights into their creative process. Whether you're an art enthusiast or simply appreciate the beauty of visual expression, the Cleckhuddersfax Art Expo offers a captivating journey through the world of art.",
    "Let the rhythm move you at the Cleckhuddersfax Dance Showcase, featuring a diverse range of dance styles and performances by talented local dance groups. From graceful ballet and contemporary dance to energetic hip-hop and traditional cultural dances, this showcase highlights the artistry and passion of Cleckhuddersfax's dance community. Experience the power of movement, storytelling, and emotion as each performance takes you on a captivating journey. Whether you're a dance aficionado or simply enjoy the beauty of movement, the Cleckhuddersfax Dance Showcase is a must-see event that celebrates the universal language of dance.",
    "Prepare to be amazed by mind-bending illusions and breathtaking stunts at the Cleckhuddersfax Magic Show. Witness the art of illusion up close as talented magicians perform mind-boggling tricks and feats of magic. From disappearing acts to mind reading and levitation, these master illusionists will leave you questioning reality and in awe of their extraordinary skills. Sit back, relax, and let the magic unfold before your eyes as you embark on a mesmerizing journey into the world of mystery and wonder.",
    "Experience the thrill of adrenaline-pumping action at the Cleckhuddersfax Extreme Sports Exhibition. Watch daring athletes showcase their skills in a variety of extreme sports, from skateboarding and BMX to rock climbing and parkour. Be captivated by their fearless stunts, gravity-defying tricks, and sheer athleticism. Whether you're an extreme sports enthusiast or simply love the thrill of spectating, this exhibition offers an exhilarating experience that pushes the boundaries of what's possible.",
  ];

              $randomEntertainmentContent = $entertainmentContents[array_rand($entertainmentContents)];

              echo "<p class='card-text'>$randomEntertainmentContent</p>";
            ?>
          </div>
        </div>
      </div>
      <div class="col">
      <div class="card">
          <div class="card-body">
        <h5 class="card-title">Deals of the Town</h5>
        <?php
$deals = [
  [
    "title" => "50% Off Spa Packages",
    "location" => "Downtown Cleckhuddersfax",
  ],
  [
    "title" => "Buy One Get One Free: Movie Tickets",
    "location" => "Westside Shopping Mall",
  ],
  [
    "title" => "Exclusive Discount: Fashion Apparel",
    "location" => "Central Market",
  ],
  [
    "title" => "Limited Time Offer: Gourmet Dining",
    "location" => "Riverside Plaza",
  ],
  [
    "title" => "Special Sale: Electronics and Gadgets",
    "location" => "Northside Retail Park",
  ],
  // Add more deals here...
];

// Display multiple deals
foreach ($deals as $deal) {
  $title = $deal["title"];
  $location = $deal["location"];

  echo "<h5>$title</h5>";
  echo "<p>Location: $location</p>";
  echo "<hr>";
}
?>
      </div></div></div>
    </div>
    
  </div>
  
  
  <div id="map" style="height: 400px;"></div>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
  // Initialize the map
  var map = L.map('map').setView([51.4739, -0.2027], 13);

  // Add the tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  // Add a marker to the map
  var marker = L.marker([51.4739, -0.2027]).addTo(map);
</script>
<br>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
