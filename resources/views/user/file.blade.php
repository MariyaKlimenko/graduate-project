<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css">
        .main{
            width: 620px;
            padding: 20px;
            font-family: "DejaVu Sans", sans-serif;
            padding-left: 50px;

        }

        .heading-text {
            position: absolute;
            top: 40px;
            left:220px;
            font-size: 18pt;
            width: 500px;
            font-weight: bold;
        }

        .heading-text-2 {
            position: absolute;
            top: 60px;
            left: 220px;
            font-size: 14pt;
        }

        .heading {
            height: 120px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .profile-image {
            position: absolute;
            left: 50px;
            top: 20px;
            object-fit: cover;
            width: 130px;
            height: 130px;
            border: solid 0 transparent;
            border-radius: 65px;
        }

        .left {
            font-size: 12pt;
            width: 120px;
            margin-right: 0;
            padding-top: 10px;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .right {
            margin-top: -60px;
            text-align: left;
            width: 500px;
            padding-left: 150px;
            font-size: 11pt;
            line-height: 10px;
        }

        ul.experience li {
            line-height: 15px;
            margin-top: 10px;
        }

        ul {
            list-style-type: square;
        }

        .contacts {
            font-size: 10pt;
            line-height: 8px;
            position: absolute;
            width: 200px;
            text-align: right;
            left: 460px;
            top: 90px;
        }

        .additional {
            line-height: 20px;
            padding-top: -7px;
        }

    </style>
</head>
<body>
<div class="main">
    <div class="heading">
        <p class="heading-text">{{ $user->name }} {{ $user->surname }}</p>
        @if($user->photo != null)
        <img class="profile-image" src="./images/{{ $user->photo}}">@endif
        <p class="heading-text-2">{{ $user->position }}</p>
        <div class="contacts">
            @if($user->info->location != null)<p>{{ $user->info->location }}</p>@endif
                @if($user->info->phone != null)<p>{{ $user->info->phone }}</p>@endif
                @if($user->email != null)<p>{{ $user->email }}</p>@endif
        </div>
    </div>
    <div>
        @if(count($user->experiences) > 0)
        <div class="block"><div class="left"><p>ОПЫТ</p></div>
            <div class="right"><ul class="experience">@foreach($experiences as $experience)
                        <li><b>{{ $experience['name'] }}</b> - {{ $experience['duration'] }}.</li>
                @endforeach
                </ul>
            </div>
        </div>
        @endif
        @if(count($user->education) > 0)
        <div class="block"><div class="left"><p>ОБРАЗОВАНИЕ</p></div>
            <div class="right"><ul>@foreach($user->education as $education)
                        <li><p>{{ $education->speciality }}, {{ $education->degree }}</p>
                            <p>{{ $education->university }}, {{ $education->country->name }}</p>
                            <p>{{ $education->started_at }}
                                -
                                @if($education->is_not_finished)
                                    настоящее время
                                @else
                                    {{$education->finished_at}}
                                @endif
                            </p></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @if(count($user->projects) > 0)
        <div class="block"><div class="left"><p>ПРОЕКТЫ</p></div>
            <div class="right"><ul>@foreach($user->projects as $project)
                        <li><p><b>{{ $project->name }}</b>,
                                {{ $project->started_at }} - {{ $project->finished_at }}
                            </p>
                            <p>{{$project->duration }} часов работы на проэкте.</p>
                            <p>
                                @if(count($project->labels) > 0)
                                @foreach($project->labels as $label)
                                    {{ $label->name }}
                                    @if((count($project->labels) > 1) && ($loop->iteration != count($project->labels)))
                                        ,
                                    @endif
                                    @if($loop->iteration == count($project->labels))
                                        .
                                    @endif
                                @endforeach
                                    @endif
                            </p></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
            @if($user->info->additional != null)
                <div class="block"><div class="left"><p>ДОПОЛНИТЕЛЬНО</p></div>
                    <div class="right additional"><ul><li><p>{{ $user->info->additional }}</p></li></ul>
                    </div>
                </div>
            @endif
    </div>
</div>
</body>
</html>

