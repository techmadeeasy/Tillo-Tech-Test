<?php
declare(strict_types=1);
// Un-comment if using composer
 require('vendor/autoload.php');

// Start your implementation here
$ordersPayload = json_decode(file_get_contents(__DIR__ . '/' . "./orders.json"), true);
$ordersJsonResource = new \Interview2025\Order($ordersPayload);
$decoratedOrders = new \Interview2025\OrderDecorator($ordersJsonResource);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tillo Technical Test - PHP</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@1.4.6/dist/base.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@1.4.6/dist/components.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@tailwindcss/typography@0.1.2/dist/typography.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@1.4.6/dist/utilities.min.css">
</head>
<body>
    <div class="container mx-auto mt-10 px-4">
    <div class="prose lg:prose-xl mb-4 lg:mb-8">
        <h1>Tillo Technical Test</h1>
        <h2>PHP Task 2 - Implementation</h2>
        <h3>Task</h3>
        <ul>
            <li>Parse the <a href="https://raw.githubusercontent.com/TilloTech/Interview2020/master/data/orders.json">orders.json</a> file and implement each of the stats below.</li>
            <li>Your solution should be visible in the browser when run using a local PHP server.
                <pre><code>$ php -S localhost:8080</code></pre></li>
            <li>We've included a <a href="https://raw.githubusercontent.com/TilloTech/Interview2020/master/php/composer.json">composer.json</a> file should you choose to pull in some external libraries to help you but this is entirely optional.</li>
            <li>How you complete the tasks is up to you.</li>
        </ul>
        <h3>Rules</h3>
        <ul>
            <li>Edit this file directly.</li>
            <li>The methods can be implemented in any way you like.</li>
            <li>Please format numbers and monetary values sensibly.</li>
            <li>Some CSS/formatting has been applied already - please keep it.</li>
            <li>It shouldn't take you more than one hour to complete.</li>
        </ul>
        <h3>Answer</h3>
    </div>
    <div>
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Count the number of orders that were...
            </h3>
            <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    FREE
                  </dt>
                  <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                    <?php echo count($decoratedOrders->freeOrder()); ?>
                  </dd>
                </dl>
              </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Placed in GBP
                  </dt>
                  <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                    <?php echo count($decoratedOrders->paidInGBP()); ?>
                  </dd>
                </dl>
              </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Shipped to Essex
                  </dt>
                  <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                    <?php echo count($decoratedOrders->shippedToEssex()); ?>
                  </dd>
                </dl>
              </div>
            </div>
            </div>
            </div>
            <div class="mt-4 sm:mt-8">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Sum the cost of orders that were...
            </h3>
            <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Placed in GBP and were £100 or more
                  </dt>
                  <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                        <?php echo array_sum(array_column($decoratedOrders->gbpOrdersWithMinAmount(), 'price')) ?>
                  </dd>
                </dl>
              </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Placed in GBP
                  </dt>
                  <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                        <?php echo array_sum(array_column($decoratedOrders->paidInGBP(), 'price')) ?>
                  </dd>
                </dl>
              </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Placed in GBP and were shipped to Essex
                  </dt>
                  <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                        <?php echo array_sum(array_column($decoratedOrders->gbpOrdersShippedToEssex(), 'price')) ?>
                  </dd>
                </dl>
              </div>
            </div>
            </div>
            </div>
    </div>
</div>
<div class="bg-white border-t border-gray-300 container mx-auto mt-8 py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
    <div class="mt-8 md:mt-0 md:order-1">
        <p class="text-center text-base leading-6 text-gray-400">
            &copy; 2020 Tillo. All rights reserved.
        </p>
    </div>
</div>
</body>
</html>
