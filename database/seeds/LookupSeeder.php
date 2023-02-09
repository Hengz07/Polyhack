<?php

use Illuminate\Database\Seeder;
use Modules\Ewp\Entities\Lookups;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            //CATEGORY
            [
                //for manage code
                "key"         => "-",
                "code"        => "category",
                "value_local" => "category",
                "desc" => "lookup"
            ],
            [ //data in category
                "key"         => "category",
                "code"        => "D",
                "value_local" => "Depression",
                "meta_value" => 
                [
                    [
                        "name" => "NORMAL",
                        "min" => 0,
                        "max" => 5,
                    ],

                    [
                        "name" => "RINGAN",
                        "min" => 6,
                        "max" => 7,
                    ],
                        
                    [
                        "name" => "SEDERHANA",
                        "min" => 8,
                        "max" => 10,
                    ],
                        
                    [
                        "name" => "TERUK",
                        "min" => 11,
                        "max" => 14,
                    ],
                        
                    [
                        "name" => "SANGAT TERUK",
                        "min" => 15,
                        "max" => 21,
                    ],
                ]

            ],
            [
                "key"         => "category",
                "code"        => "A",
                "value_local" => "Anxiety",
                "meta_value" => 
                [
                    [
                        "name" => "NORMAL",
                        "min" => 1,
                        "max" => 4,
                    ],

                    [
                        "name" => "RINGAN",
                        "min" => 5,
                        "max" => 6,
                    ],
                        
                    [
                        "name" => "SEDERHANA",
                        "min" => 7,
                        "max" => 8,
                    ],
                        
                    [
                        "name" => "TERUK",
                        "min" => 9,
                        "max" => 10,
                    ],
                        
                    [
                        "name" => "SANGAT TERUK",
                        "min" => 11,
                        "max" => 21,
                    ],
                ]
            ],
            [
                "key"         => "category",
                "code"        => "S",
                "value_local" => "Stress",
                "meta_value" => 
                [
                    [
                        "name" => 'NORMAL',
                        "min" => 1,
                        "max" => 7,
                    ],

                    [
                        "name" => 'RINGAN',
                        "min" => 8,
                        "max" => 9,
                    ],
                        
                    [
                        "name" => 'SEDERHANA',
                        "min" => 10,
                        "max" => 13,
                    ],
                        
                    [
                        "name" => 'TERUK',
                        "min" => 14,
                        "max" => 17,
                    ],
                        
                    [
                        "name" => 'SANGAT TERUK',
                        "min" => 18,
                        "max" => 21,
                    ],
                ]
            ],

            //QUESTIONS
            [
                "key"         => "questions",
                "code"        => "S1",
                "value_local" => "Saya rasa susah untuk bertenang",
                "value_translation" => "I find it difficult to calm down",
                "desc" => "Stress Question",
                "meta_value" =>
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 1,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "A1",
                "value_local" => "Saya sedar mulut saya rasa kering",
                "value_translation" => "I was aware of dryness of my mouth",
                "desc" => "Anxiety Question",
                "meta_value" =>
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 2,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D1",
                "value_local" => "Saya seolah-olah tidak dapat mengalami perasaan positif sama sekali",
                "value_translation" => "I couldnt seem to experience any positive feeling at all",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 3,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "A2",
                "value_local" => "Saya mengalami kesukaran bernafas (contohnya bernafas terlalu cepat, tercungap-cungap walaupun tidak melakukan aktiviti fizikal)",
                "value_translation" => "I experienced breathing difficulty (e.g. excessively rapid breathing, breathlessness in the absence of physical exertion)",
                "desc" => "Anxiety Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 4,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D2",
                "value_local" => "Saya rasa tidak bersemangat untuk memulakan sesuatu keadaan.",
                "value_translation" => "I found it difficult to work up the initiative to do things.",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 5,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "S2",
                "value_local" => "Saya cenderung bertindak secara berlebihan kepada sesuatu keadaan.",
                "value_translation" => "I tended to over-react to situations.",
                "desc" => "Stress Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 6,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "A3",
                "value_local" => "Saya pernah menggeletar (contohnya tangan).",
                "value_translation" => "I experienced trembling (e.g in the hands).",
                "desc" => "Anxiety Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 7,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "S3",
                "value_local" => "Saya rasa saya terlalu gelisah.",
                "value_translation" => "I felt that I was using a lot of nervous energy.",
                "desc" => "Stress Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 8,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "A4",
                "value_local" => "Saya risau akan berlaku keadaan di mana panik dan berkelakuan bodoh.",
                "value_translation" => "I am worried about situations in which I might panic and make a fool of myself.",
                "desc" => "Anxiety Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 9,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D3",
                "value_local" => "Saya rasa tidak ada apa yang saya harapkan (putus harapan).",
                "value_translation" => "I felt that I have nothing to look forward.",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 10,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "S4",
                "value_local" => "Saya dapati saya mudah resah.",
                "value_translation" => "I found myself getting agitated.",
                "desc" => "Stress Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 11,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "S5",
                "value_local" => "Saya merasa sukar untuk bertenang.",
                "value_translation" => "I find it hard to calm down.",
                "desc" => "Stress Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 12,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D4",
                "value_local" => "Saya rasa muram dan sedih.",
                "value_translation" => "I feel sad and blue.",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 13,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "S6",
                "value_local" => "Saya tidak boleh terima apa jua yang menghalangi saya daripada meneruskan apa yang saya sedang lakukan.",
                "value_translation" => "I am intolerant of anything that kept me from getting on with what I was doing.",
                "desc" => "Stress Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 14,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "A5",
                "value_local" => "Saya rasa hampir panik.",
                "value_translation" => "I felt like panicking.",
                "desc" => "Anxiety Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 15,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D5",
                "value_local" => "Saya tidak bersemangat langsung.",
                "value_translation" => "I am not enthusiastic about anything.",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 16,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D6",
                "value_local" => "Saya rasa diri saya tidak berharga.",
                "value_translation" => "I felt I wasnt worth much as a person.",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 17,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "S7",
                "value_local" => "Saya mudah tersinggung.",
                "value_translation" => "I am easily offended.",
                "desc" => "Stress Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Stress",
                    "code" => "S",
                    "order" => 18,
                    "version" => "1"
                ]       
            ],
            [
                "key"         => "questions",
                "code"        => "A6",
                "value_local" => "Walaupun saya tidak melakukan aktiviti fizikal,saya sedar akan debaran jantung saya (contoh degupan jantung lebih cepat).",
                "value_translation" => "I was aware of the action of my heart in the absence of physical exertion (e.g. sense of heart rate increase, heart missing a beat).",
                "desc" => "Anxiety Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 19,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "A7",
                "value_local" => "Saya rasa saya terlalu gelisah.",
                "value_translation" => "I felt that I was using a lot of nervous energy.",
                "desc" => "Anxiety Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Anxiety",
                    "code" => "A",
                    "order" => 20,
                    "version" => "1"
                ]
            ],
            [
                "key"         => "questions",
                "code"        => "D7",
                "value_local" => "Saya rasa hidup ini tidak bererti lagi.",
                "value_translation" => "I feel that my life is meaningless.",
                "desc" => "Depression Question",
                "meta_value" => 
                [
                    "status" => "Y",
                    "name" => "Depression",
                    "code" => "D",
                    "order" => 21,
                    "version" => "1"
                ]
            ],

            //SCALES
            [
                "key"         => "scales",
                "code"        => "1",
                "value_local" => "NORMAL",
                "value_translation" => "NORMAL",
                "desc" => "NORMAL Scale",
                "meta_value" => null
            ],
            [
                "key"         => "scales",
                "code"        => "2",
                "value_local" => "RINGAN",
                "value_translation" => "LIGHT",
                "desc" => "LIGHT Scale",
                "meta_value" => null
            ],
            [
                "key"         => "scales",
                "code"        => "3",
                "value_local" => "SEDERHANA",
                "value_translation" => "MILD",
                "desc" => "MILD Scale",
                "meta_value" => null
            ],
            [
                "key"         => "scales",
                "code"        => "4",
                "value_local" => "TERUK",
                "value_translation" => "BAD",
                "desc" => "BAD Scale",
                "meta_value" => null
            ],
            [
                "key"         => "scales",
                "code"        => "5",
                "value_local" => "SANGAT TERUK",
                "value_translation" => "VERY BAD",
                "desc" => "VERY BAD Scale",
                "meta_value" => null
            ],

            //ANSWER DESCRIPTION
            [
                "key"         => "ans_desc",
                "code"        => "0",
                "value_local" => "Tidak pernah sama sekali",
                "value_translation" => "Did not apply to me at all",
                "desc" =>"icheck-primary",
                "meta_value" => null
            ],
            [
                "key"         => "ans_desc",
                "code"        => "1",
                "value_local" => "Jarang",
                "value_translation" => "Applied to me to a considerable degree or a good part of time",
                "desc" =>"icheck-success",
                "meta_value" => null
            ],
            [
                "key"         => "ans_desc",
                "code"        => "2",
                "value_local" => "Kerap",
                "value_translation" => "Applied to me to some degree, or some of the time",
                "desc" =>"icheck-warning",
                "meta_value" => null
            ],
            [
                "key"         => "ans_desc",
                "code"        => "3",
                "value_local" => "Sangat kerap",
                "value_translation" => "Applied to me very much or most of the time",
                "desc" =>"icheck-danger",
                "meta_value" => null
            ],

            //RUMUSAN (REKOD KHAS)
            //ISSUE
            [
                "key"         => '-',
                "code"        => "issue",
                "value_local" => "issue",
                "desc"        => "lookup"
            ],
            [
                "key"         => 'issue',
                "code"        => "Peribadi",
                "value_local" => "Peribadi",
                "desc"        => "Issue 1"
            ],
            [
                "key"         => 'issue',
                "code"        => "Keluarga",
                "value_local" => "Keluarga",
                "desc"        => "Issue 2"
            ],
            [
                "key"         => 'issue',
                "code"        => "Akademik",
                "value_local" => "Akademik",
                "desc"        => "Issue 3"
            ],
            [
                "key"         => 'issue',
                "code"        => "Kewangan",
                "value_local" => "Kewangan",
                "desc"        => "Issue 4"
            ],
            [
                "key"         => 'issue',
                "code"        => "Ujian Psikologi",
                "value_local" => "Ujian Psikologi",
                "desc"        => "Issue 5"
            ],
            [
                "key"         => 'issue',
                "code"        => "Kecelaruan Mental",
                "value_local" => "Kecelaruan Mental",
                "desc"        => "Issue 6"
            ],
            //STATUS
            [
                "key"         => '-',
                "code"        => "status",
                "value_local" => "status",
                "desc"        => "lookup"
            ],
            [
                "key"         => 'status',
                "code"        => "Rujuk",
                "value_local" => "Rujuk",
                "desc"        => "Status 1"
            ],
            [
                "key"         => 'status',
                "code"        => "Selesai",
                "value_local" => "Selesai",
                "desc"        => "Status 2"
            ],
            [
                "key"         => 'status',
                "code"        => "Belum Selesai",
                "value_local" => "Belum Selesai",
                "desc"        => "Status 3"
            ],
            //REFER
            [
                "key"         => '-',
                "code"        => "refer",
                "value_local" => "refer",
                "desc"        => "lookup"
            ],
            [
                "key"         => 'refer',
                "code"        => "Psikiatrik",
                "value_local" => "Psikiatrik",
                "desc"        => "Refer 1"
            ],
            [
                "key"         => 'refer',
                "code"        => "Kesihatan",
                "value_local" => "Kesihatan",
                "desc"        => "Refer 2"
            ],
            [
                "key"         => 'refer',
                "code"        => "Agama",
                "value_local" => "Agama",
                "desc"        => "Refer 3"
            ],
            [
                "key"         => 'refer',
                "code"        => "Kebajikan",
                "value_local" => "Kebajikan",
                "desc"        => "Refer 4"
            ],
        ];

        foreach($items as $item){
        if(array_key_exists('meta_value', $item)){
            $item['meta_value'] = json_encode($item['meta_value']);
            }

            Lookups::UpdateOrCreate(['key'=>$item['key'], 'code'=>$item['code']],$item);
        }
    }
}

