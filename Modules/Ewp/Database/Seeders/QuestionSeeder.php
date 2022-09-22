<?php




use Illuminate\Database\Seeder;
use Modules\Ewp\Entities\Question;


class QuestionSeeder extends Seeder
{

    public function run()
    {
        
        
        $items = [
            [   #1
                'BM' => 'Saya rasa susah untuk bertenang.', 
                'BI' => 'I find it difficult to calm down.', 
                'Status' => 'Y', 
                'Bahagian' => 'Stress',
                'section' => 'S1',
            ],
            [   #2
                'BM' => 'Saya sedar mulut saya rasa kering', 
                'BI' => 'I was aware of dryness of my mouth', 
                'Status' => 'Y', 
                'Bahagian' => 'Anxiety',
                'section' => 'A1',
            ],
            [   #3
                'BM' => 'Saya seolah-olah tidak dapat mengalami perasaan positif sama sekali', 
                'BI' => 'I couldnt seem to experience any positive feeling at all.', 
                'Status' => 'Y', 
                'Bahagian' => 'Depression',
                'section' => 'D1',
            ],
            [   #4
                'BM' => 'Saya mengalami kesukaran bernafas (contohnya bernafas terlalu cepat, 
                tercungap-cungap walaupun tidak melakukan aktiviti fizikal).', 
                'BI' => 'I experienced breathing difficulty (e.g. excessively rapid breathing, breathlessness in the absence of physical exertion).		', 
                'Status' => 'Y', 
                'Bahagian' => 'Anxiety',
                'section' => ' A2',
            ],
            [   #5
                'BM' => 'Saya rasa tidak bersemangat untuk memulakan sesuatu keadaan.', 
                'BI' => 'I found it difficult to work up the initiative to do things.', 
                'Status' => 'Y', 
                'Bahagian' => 'Depression',
                'section' => 'D2',
            ],
            [   #6
                'BM' => 'Saya cenderung bertindak secara berlebihan kepada sesuatu keadaan.', 
                'BI' => 'I tended to over-react to situations.', 
                'Status' => 'Y', 
                'Bahagian' => 'Stress',
                'section' => 'S2',
            ],
            [   #7
                'BM' => 'Saya pernah menggeletar (contohnya tangan).', 
                'BI' => 'I experienced trembling (e.g. in the hands).', 
                'Status' => 'Y', 
                'Bahagian' => 'Anxiety',
                'section' => 'A3',
            ],
            [   #8
                'BM' => 'Saya rasa saya terlalu gelisah.', 
                'BI' => 'I felt that I was using a lot of nervous energy.', 
                'Status' => 'Y', 
                'Bahagian' => 'Stress',
                'section' => 'S3',
            ],
            [   #9
                'BM' => 'Saya risau akan berlaku keadaan di mana panik dan berkelakuan bodoh.', 
                'BI' => 'I am worried about situations in which I might panic and make a fool of myself.', 
                'Status' => 'Y', 
                'Bahagian' => 'Anxiety',
                'section' => 'A4',
            ],
            [   #10
                'BM' => 'Saya rasa tidak ada apa yang saya harapkan (putus harapan).', 
                'BI' => 'I felt that I have nothing to look forward', 
                'Status' => 'Y', 
                'Bahagian' => 'Depression',
                'section' => 'D3',
            ],
            [   #11
                'BM' => 'Saya dapati saya mudah resah.', 
                'BI' => 'I found myself getting agitated.', 
                'Status' => 'Y', 
                'Bahagian' => 'Stress',
                'section' => 'S4',
            ],
            [   #12
                'BM' => 'Saya merasa sukar untuk bertenang.', 
                'BI' => 'I find it hard to calm down.', 
                'Status' => 'Y', 
                'Bahagian' => 'Stress',
                'section' => 'S5',
            ], 
            [   #13
            'BM' => 'Saya rasa muram dan sedih.', 
            'BI' => 'I feel sad and blue.', 
            'Status' => 'Y', 
            'Bahagian' => 'Depression',
            'section' => 'D4',
        ],
        [   #14
            'BM' => 'Saya tidak boleh terima apa jua yang menghalangi 
            saya daripada meneruskan apa yang saya sedang lakukan.', 
            'BI' => 'I am intolerant of anything that kept me from getting on with what I was doing.', 
            'Status' => 'Y', 
            'Bahagian' => 'Stress',
            'section' => 'S6',
        ],
        [   #15
            'BM' => 'Saya rasa hampir panik. ', 
            'BI' => 'I felt like panicking.', 
            'Status' => 'Y', 
            'Bahagian' => 'Anxiety',
            'section' => 'A5',
        ],
        [   #16
            'BM' => 'Saya tidak bersemangat langsung.', 
            'BI' => 'I am not enthusiastic about anything.', 
            'Status' => 'Y', 
            'Bahagian' => 'Depression',
            'section' => 'D5',
        ],
        [   #17
            'BM' => 'Saya rasa diri saya tidak berharga.', 
            'BI' => 'I felt I wasnt worth much as a person.', 
            'Status' => 'Y', 
            'Bahagian' => 'Depression',
            'section' => 'D6',
        ],
        [   #18
            'BM' => 'Saya mudah tersinggung.', 
            'BI' => 'I am easily offended.', 
            'Status' => 'Y', 
            'Bahagian' => 'Stress',
            'section' => 'S6',
        ],
        [   #19
            'BM' => 'Walaupun saya tidak melakukan aktiviti fizikal,saya sedar akan debaran jantung saya (contoh degupan jantung lebih cepat).', 
            'BI' => 'I was aware of the action of my heart in the absence of physical exertion 
            (e.g. sense of heart rate increase, heart missing a beat).', 
            'Status' => 'Y', 
            'Bahagian' => 'Anxiety',
            'section' => 'A6',
        ],
        [   #20
            'BM' => 'Saya rasa saya terlalu gelisah.', 
            'BI' => 'I felt that I was using a lot of nervous energy.', 
            'Status' => 'Y', 
            'Bahagian' => 'Anxiety',
            'section' => 'A7',
        ],
        [   #21
            'BM' => 'Saya rasa hidup ini tidak bererti lagi.', 
            'BI' => 'I feel that my life is meaningless.', 
            'Status' => 'Y', 
            'Bahagian' => 'Depression',
            'section' => 'D7',
        ]
        ];

        foreach ($items as $item) {
            Question::create($item);
        }
    }
}
