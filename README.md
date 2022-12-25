# Сontest Notifier
* Get the nearest contest from codeforces in the most convenient format for the Internet
* Use data everywhere
* Open Source
<hr>

## How it work
1. get json data from codeforces api by **curl**
    ```PHP
        $response = curl_exec($ch);
    ```
2. parse all contest and select the nearest
    ```PHP
        foreach ($json->result as $contest)
    ```
3. converting time from seconds to format DD:HH:MM:SS
    ```PHP
        set_time($best_contest);
    ```
4. return json
    ```PHP
        header('Content-type: application/json');
	    echo json_encode($post_data);
    ```
## Where it use
For example you can use it in widgets(IOS and Android) <br>
-> Simplest app is [widgetopia](https://widgetopia.io) <br>
-> The best IOS app is [widgeridoo](https://apps.apple.com/us/app/widgeridoo/id1531359008)<br>
You can also create a telegram bot that will remind you 20 minutes before the start of the contest

## Try it
Test website with a script [here](http://contest-notifier.000webhostapp.com)
