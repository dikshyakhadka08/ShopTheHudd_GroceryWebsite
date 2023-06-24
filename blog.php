<!DOCTYPE html>
<html>
<head>
    <title>ShopTheHudd Social Media</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .tweet {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .tweet .username {
            font-weight: bold;
        }

        .tweet .timestamp {
            color: #777;
            font-size: 12px;
        }

        .tweet .message {
            margin-top: 10px;
        }

        .tweet .actions {
            margin-top: 10px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .user-info .username {
            font-weight: bold;
            margin-left: 10px;
        }

        .post-form {
            margin-bottom: 20px;
        }

        .post-form textarea {
            width: 100%;
            resize: vertical;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        .post-actions {
            display: flex;
            justify-content: flex-end;
        }

        .trends {
            margin-top: 30px;
        }

        .trends .title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .trends ul {
            list-style-type: none;
            padding: 0;
        }

        .ad {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .ad .title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .ad .content {
            margin-top: 10px;
        }

        .ad .actions {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ShopTheHudd Social Media</h1>

        <div class="post-form">
            <form>
                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="What's on your mind?"></textarea>
                </div>
                <div class="post-actions">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="trends">
                    <h2 class="title">Top Trends</h2>
                    <ul>
                        <li>#Fashion</li>
                        <li>#ShopTheHudd</li>
                        <li>#SummerSale</li>
                        <li>#NewArrivals</li>
                        <li>#FashionInspiration</li>
                        <li>#OOTD</li>
                        <li>#TravelFashion</li>
                        <li>#StreetStyle</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ad">
                    <h2 class="title">Featured Ad</h2>
                    <p class="content">Get ready for summer with our latest collection of beachwear and accessories!</p>
                    <div class="actions">
                        <button type="button" class="btn btn-primary">Shop Now</button>
                    </div>
                </div>
                <div class="ad">
                    <h2 class="title">Special Offer</h2>
                    <p class="content">Limited time offer: Get 20% off on all accessories!</p>
                    <div class="actions">
                        <button type="button" class="btn btn-primary">Claim Offer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tweets">
            <h2>Latest Tweets</h2>

            <?php
            // Generate fake tweets
            $tweets = [
                [
                    'username' => 'Shopaholic',
                    'message' => 'Just bought the most amazing dress! #Fashion',
                    'timestamp' => '2023-06-10 12:30:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/04/01/10/04/amusing-1299761_1280.png'
                ],
                [
                    'username' => 'FashionGuru',
                    'message' => 'In love with the new fashion trends! 😍 #ShopTheHudd',
                    'timestamp' => '2023-06-10 14:45:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/04/01/10/04/amusing-1299761_1280.png'
                ],
                [
                    'username' => 'Fashionista',
                    'message' => 'Check out this amazing outfit! 😍👗',
                    'timestamp' => '2023-06-10 18:20:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/03/31/20/27/avatar-1295773_1280.png'
                ],
                [
                    'username' => 'StyleEnthusiast',
                    'message' => 'Sharing my latest fashion haul! #NewArrivals',
                    'timestamp' => '2023-06-10 20:15:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/03/31/20/27/avatar-1295773_1280.png'
                ],
                [
                    'username' => 'FashionBlogger',
                    'message' => 'New blog post is up! Check out my summer fashion tips. ☀️ #SummerStyle',
                    'timestamp' => '2023-06-10 22:10:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/08/21/16/31/emoticon-1610228_1280.png'
                ],
                [
                    'username' => 'TrendSetter',
                    'message' => 'Can\'t get enough of these trendy accessories! #FashionAddict',
                    'timestamp' => '2023-06-11 09:30:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/08/21/16/31/emoticon-1610228_1280.png'
                ],
                [
                    'username' => 'FashionForward',
                    'message' => 'Attending the fashion event tonight! So excited! #FashionEvent',
                    'timestamp' => '2023-06-11 11:45:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2014/04/03/10/32/user-310807_1280.png'
                ],
                [
                    'username' => 'FashionLover',
                    'message' => 'Obsessed with the latest shoe collection! 😍👠 #ShoeLove',
                    'timestamp' => '2023-06-11 14:20:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2014/04/03/10/32/user-310807_1280.png'
                ],
                [
                    'username' => 'StyleIcon',
                    'message' => 'Embracing my unique style. #FashionStatement',
                    'timestamp' => '2023-06-11 17:00:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_1280.png'
                ],
                [
                    'username' => 'FashionAddict',
                    'message' => 'Can\'t resist a good sale! #Shopaholic',
                    'timestamp' => '2023-06-11 19:45:00',
                    'avatar' => 'https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_1280.png'
                ],
            ];

            foreach ($tweets as $tweet) {
                echo '<div class="tweet">';
                echo '<div class="user-info">';
                echo '<img src="' . $tweet['avatar'] . '" alt="User Avatar" class="user-avatar">';
                echo '<span class="username">' . $tweet['username'] . '</span>';
                echo '</div>';
                echo '<p class="message">' . $tweet['message'] . '</p>';
                echo '<div class="timestamp">' . $tweet['timestamp'] . '</div>';
                echo '</div>';
            }
            ?>

        </div>
    </div>
</body>
</html>
