Access to [BoredApi](https://www.boredapi.com/documentation) via console commands.


<details>
<summary><b>Build</b></summary>

    docker-compose build

</details>


<details>
<summary><b>Deploy</b></summary>

    docker-compose up -d

</details>


<details>
<summary><b>Usage</b></summary>

Enter container:

    docker exec -ti php-cli sh

Install dependencies:

    php composer.phar update

View list of availbable commands at the BoredApi section

    php index.php

Every command has Help, for example

    php index.php BoredApi:getRandomActivityWithType --help

<h3>Commands: </h3>

Get random activity

    php php index.php BoredApi:GetRandomActivity

Get an activity within price range

    php index.php BoredApi:GetRandomActivityInPriceRange 0.2 0.3

Get an activity with specific type

    php index.php BoredApi:getRandomActivityWithType cooking

</details>


<details>
<summary><b>After Usage</b></summary>

    docker-compose down -t 0

</details>