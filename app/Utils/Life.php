<?php

namespace App\Utils;

class Life {

    static function cycle()
    {
        $persons = \App\Models\LifePersons::all();
        $events = \App\Models\LifeEvents::all();
        $return = [];

        foreach($persons as $person_from) {
            $person_to = $persons->random();
            $event = $events->random();
            $return[] = $event->run($person_from, $person_to);
        }

        return $return;

        // $persons = \App\Utils\Life\Event::traverse($persons);
        
        // dump($persons);

        // $return['lifePersonsMinimalCreate'] = self::lifePersonsMinimalCreate();
        // $return['lifePersonsFix'] = self::lifePersonsFix($persons);
        // $return['lifePersonsGrow'] = self::lifePersonsGrow($persons);
        // $return['lifePersonsRandomInteraction'] = self::lifePersonsRandomInteraction($persons);
        // return $return;
    }

    static function test()
    {
        // $user1 = \App\Models\LifePersons::inRandomOrder()->first();
        // $user2 = \App\Models\LifePersons::inRandomOrder()->first();

        $user1 = \App\Models\LifePersons::find(64);
        $user2 = \App\Models\LifePersons::find(57);

        $interaction = (new \App\Utils\Life\interaction\Pregnant($user1, $user2))->handle();
        // dd($interaction);
    }

    static function interactions()
    {
        return collect(array_map(function($file) {
            $class = pathinfo($file, PATHINFO_FILENAME);
            return "\App\Utils\Life\Interaction\\{$class}";
        }, glob(base_path('app/Utils/Life/Interaction/*.php'))));
    }


    static function lifePersonsRandomInteraction($persons)
    {
        $person1 = $persons->filter(function($person) {
            if ($person->is_dead) return false;
            if ($person->age<18) return false;
            return true;
        })->random();

        $person2 = $persons->filter(function($person) {
            if ($person->is_dead) return false;
            if ($person->age<18) return false;
            return true;
        })->random();
        
        $interaction = self::interactions()->random();
        $interaction = new $interaction($person1, $person2);
        return $interaction->handle();
    }


    static function date($date_now=null)
    {
        $date_now = $date_now? $date_now: date('Y-m-d H:i:s');
        $life_beginning_datetime = config('life.beginning_datetime');
        $life_year = config('life.year');
        $life_days_in_year = config('life.days_in_year');
        $date_diff = strtotime($date_now) - strtotime($life_beginning_datetime);

        $year = ($date_diff / $life_year);
        $days = $year * $life_days_in_year;
        $day = $days % $life_days_in_year;
        
        return (object) [
            'time' => $date_diff,
            'days' => $days,
            'year' => $year,
            'day' => $day,
        ];
    }

    static function lifePersonsFix($persons)
    {
        // foreach($persons as $person) {
        //     // 
        // }
    }

    static function lifePersonsMinimalCreate()
    {
        $minimal = 10;
        $count = \App\Models\LifePersons::select(['id'])->whereNull('is_dead')->count();
        $date = self::date();

        if ($count < $minimal) {
            $persons = [];

            $resp = (new \GuzzleHttp\Client)->request('GET', 'https://randomuser.me/api/?gender=female&results='.($minimal/2))->getBody()->getContents();
            $resp = json_decode($resp, true);
            $persons = array_merge($persons, $resp['results']);

            $resp = (new \GuzzleHttp\Client)->request('GET', 'https://randomuser.me/api/?gender=male&results='.($minimal/2))->getBody()->getContents();
            $resp = json_decode($resp, true);
            $persons = array_merge($persons, $resp['results']);
            
            foreach($persons as $user) {
                $save['name'] = "{$user['name']['first']} {$user['name']['last']}";
                $save['gender'] = $user['gender'];
                $save['photo'] = $user['picture']['large'];
                $save['age'] = rand(18, 45);
                $save['birth'] = $date->year - $save['age'];
                \App\Models\LifePersons::create($save);
            }
        }
    }

    static function lifePersonsGrow($persons)
    {
        $date = self::date();

        foreach($persons as $person) {
            if ($person->is_dead) continue;

            $person->age = $date->year - $person->birth;
            $person->save();
        }
    }
}