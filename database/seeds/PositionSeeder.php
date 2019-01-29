<?php

use Illuminate\Database\Seeder;

use App\Position;
use App\Section;
use App\Department;
use App\Division;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $omni = "PT Omni Intivision";
      $epr = "PT Elang Prima Retailindo";
      
      // Insert Division
      $divisions = [
        [
          'name' => 'Finance',
          'company' => $omni,
          'departments' => [
            [
              'name' => 'Finance & Accounting',
              'positions' => [
                [
                  'name' => 'Billing & Collection Officer'
                ],
                [
                  'name' => 'Finance & Accounting Department Head'
                ],
                [
                  'name' => 'Finance Supervisor'
                ],
                [
                  'name' => 'General Accounting Supervisor'
                ],
              ]
            ],
            [
              'name' => 'Legal',
              'sections' => [
                [
                  'name' => 'Legal',
                  'positions' => [
                    [
                      'name' => 'Legal Supervisor',
                    ]
                  ]
                ]
              ]
            ],
            [
              'name' => 'Procurement',
              'sections' => [
                [
                  'name' => 'Procurement',
                  'positions' => [
                    [
                      'name' => 'Procurement Supervisor',
                    ]
                  ]
                ]
              ]
            ],
            [
              'name' => 'Tax',
              'sections' => [
                [
                  'name' => 'Tax',
                  'positions' => [
                    [
                      'name' => 'Tax Section Head',
                    ]
                  ]
                ]
              ]
            ],
            [
              'name' => 'Traffic',
              'sections' => [
                [
                  'name' => 'Traffic',
                  'positions' => [
                    [
                      'name' => 'Traffic Section Head',
                    ],
                    [
                      'name' => 'Traffic Supervisor',
                    ],
                  ]
                ]
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Finance Division Head'
            ]
          ]
        ],
        [
          'name' => 'HRGA',
          'company' => $omni,
          'departments' => [
            [
              'name' => 'GA',
              'positions' => [
                [
                  'name' => 'GA Supervisor'
                ]
              ]
            ],
            [
              'name' => 'HR',
              'positions' => [
                [
                  'name' => 'HR Officer'
                ],
                [
                  'name' => 'HR Operations Officer'
                ],
                [
                  'name' => 'HR Supervisor'
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'HRGA Division Head'
            ]
          ]
        ],
        [
          'name' => 'Programming',
          'company' => $omni,
          'departments' => [
            [
              'name' => 'Editing Graphic Production',
              'sections' => [
                [
                  'name' => 'Editing',
                  'positions' => [
                    [
                      'name' => 'Editing Section Head',
                    ],
                    [
                      'name' => 'Editing Supervisor',
                    ],
                    [
                      'name' => 'Video Editor',
                    ],
                  ]
                ],
                [
                  'name' => 'Graphic Design',
                  'positions' => [
                    [
                      'name' => 'Graphic Design Section Head',
                    ],
                    [
                      'name' => 'Graphic Designer',
                    ],
                  ]
                ],
                [
                  'name' => 'Graphic Motion',
                  'positions' => [
                    [
                      'name' => 'Graphic Motion Section Head',
                    ],
                    [
                      'name' => 'Motion Designer',
                    ],
                  ]
                ],
                [
                  'name' => 'Multimedia',
                  'positions' => [
                    [
                      'name' => 'Multimedia Designer',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Editing Graphic Production Department Head'
                ]
              ]
            ],
            [
              'name' => 'Production',
              'sections' => [
                [
                  'name' => 'Home Shopping',
                  'positions' => [
                    [
                      'name' => 'Associate Producer'
                    ],
                    [
                      'name' => 'Executive Producer'
                    ],
                    [
                      'name' => 'Producer'
                    ],
                    [
                      'name' => 'Production Assistant'
                    ],
                  ]
                ],
                [
                  'name' => 'Program',
                  'positions' => [
                    [
                      'name' => 'Associate Producer'
                    ],
                    [
                      'name' => 'Executive Producer'
                    ],
                    [
                      'name' => 'Producer'
                    ],
                    [
                      'name' => 'Production Assistant'
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Production Department Head'
                ],
                [
                  'name' => 'Creative'
                ],
                [
                  'name' => 'Senior Creative'
                ],
              ]
            ],
            [
              'name' => 'Production Services',
              'sections' => [
                [
                  'name' => 'Art',
                  'positions' => [
                    [
                      'name' => 'Art Section Head'
                    ],
                    [
                      'name' => 'Set & Property Crew'
                    ],
                    [
                      'name' => 'Set & Property Supervisor'
                    ],
                    [
                      'name' => 'Stylist'
                    ],
                    [
                      'name' => 'Stylist & Make Up Supervisor'
                    ],
                  ]
                ],
                [
                  'name' => 'Camera & Lighting',
                  'positions' => [
                    [
                      'name' => 'Camera & Lighting Supervisor'
                    ],
                    [
                      'name' => 'Camera Person'
                    ],
                    [
                      'name' => 'Lightingman'
                    ],
                  ]
                ],
                [
                  'name' => 'Control Room',
                  'positions' => [
                    [
                      'name' => 'Audioman'
                    ],
                    [
                      'name' => 'CG Operator'
                    ],
                    [
                      'name' => 'Control Room Supervisor'
                    ],
                    [
                      'name' => 'Switcherman'
                    ],
                    [
                      'name' => 'VT Operator'
                    ],
                  ]
                ],
                [
                  'name' => 'Director',
                  'positions' => [
                    [
                      'name' => 'Program Director'
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Production Services Department Head'
                ]
              ]
            ],
            [
              'name' => 'Program Services',
              'sections' => [
                [
                  'name' => 'OAP',
                  'positions' => [
                    [
                      'name' => 'OAP Crew'
                    ],
                    [
                      'name' => 'OAP Supervisor'
                    ],
                  ]
                ],
                [
                  'name' => 'QC',
                  'positions' => [
                    [
                      'name' => 'QC & Subtitling Officer'
                    ],
                    [
                      'name' => 'QC & Subtitling Supervisor'
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Library Officer'
                ],
                [
                  'name' => 'Program Services Department Head'
                ],
                [
                  'name' => 'Program Services Officer'
                ],
                [
                  'name' => 'Program & Acquisition Officer'
                ],
                [
                  'name' => 'Schedulling Officer'
                ],
              ]
            ],
            [
              'name' => 'R&D',
              'sections' => [
                [
                  'name' => 'R&D',
                  'positions' => [
                    [
                      'name' => 'Research & Development Officer'
                    ],
                    [
                      'name' => 'Research & Development Section Head'
                    ],
                  ]
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Programming Division Head'
            ]
          ]
        ],
        [
          'name' => 'Sales & Marketing',
          'company' => $omni,
          'departments' => [
            [
              'name' => 'Marketing',
              'positions' => [
                [
                  'name' => 'Marketing Department Head'
                ],
                [
                  'name' => 'Senior Marketing Officer'
                ],
              ]
            ],
            [
              'name' => 'Marketing Communication',
              'positions' => [
                [
                  'name' => 'Digital Marketing Officer'
                ],
                [
                  'name' => 'Marketing Communication Department Head'
                ],
                [
                  'name' => 'Marketing Communication Officer'
                ],
                [
                  'name' => 'Promotion Officer'
                ],
                [
                  'name' => 'Promotion Supervisor'
                ],
              ]
            ],
            [
              'name' => 'Sales',
              'positions' => [
                [
                  'name' => 'Account Executive'
                ],
                [
                  'name' => 'Account Manager'
                ],
                [
                  'name' => 'Sales Department Head'
                ],
                [
                  'name' => 'Sales Support Officer'
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Sales & Marketing Division Head'
            ]
          ]
        ],
        [
          'name' => 'Technical',
          'company' => $omni,
          'departments' => [
            [
              'name' => 'IT',
              'positions' => [
                [
                  'name' => 'Information Technology Department Head'
                ],
                [
                  'name' => 'IT Support'
                ],
                [
                  'name' => 'IT Support & Network Section Head'
                ],
                [
                  'name' => 'Senior Developer'
                ],
              ]
            ],
            [
              'name' => 'Technical Operation',
              'positions' => [
                [
                  'name' => 'Technical Operation Department Head'
                ],
                [
                  'name' => 'Technical Support Engineer'
                ],
                [
                  'name' => 'Technical Support Section Head'
                ],
              ]
            ],
            [
              'name' => 'Transmission',
              'positions' => [
                [
                  'name' => 'Transmission Department Head'
                ],
                [
                  'name' => 'Transmission Engineer'
                ],
                [
                  'name' => 'Transmission Supervisor'
                ],
              ]
            ],
          ]
        ],
        [
          'name' => 'Finance',
          'company' => $epr,
          'departments' => [
            [
              'name' => 'Finance & Accounting',
              'positions' => [
                [
                  'name' => 'Finance & Accounting Department Head'
                ],
                [
                  'name' => 'Finance & Accounting Section Head'
                ],
                [
                  'name' => 'Finance & Accounting Officer'
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Finance Division Head'
            ]
          ]
        ],
        [
          'name' => 'Merchandising & Marketing',
          'company' => $epr,
          'departments' => [
            [
              'name' => 'Marketing',
              'sections' => [
                [
                  'name' => 'Digital',
                  'positions' => [
                    [
                      'name' => 'Digital Marketing Officer'
                    ],
                    [
                      'name' => 'Digital Marketing Section Head'
                    ],
                    [
                      'name' => 'Social Media Officer'
                    ],
                  ]
                ],
                [
                  'name' => 'Non Digital',
                  'positions' => [
                    [
                      'name' => 'Promotion Officer'
                    ],
                    [
                      'name' => 'Promotion Section Head'
                    ],
                  ]
                ],
              ]
            ],
            [
              'name' => 'Merchandising',
              'sections' => [
                [
                  'name' => 'Grid',
                  'positions' => [
                    [
                      'name' => 'Merchandising Administrator'
                    ]
                  ]
                ],
                [
                  'name' => 'Merchandiser',
                  'positions' => [
                    [
                      'name' => 'Merchandising Administrator'
                    ]
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'E-Commerce Administrator'
                ],
                [
                  'name' => 'Grid Supervisor'
                ],
                [
                  'name' => 'Merchandiser'
                ],
                [
                  'name' => 'Merchandising & Marketing Division Head'
                ],
                [
                  'name' => 'Merchandising Department Head'
                ],
                [
                  'name' => 'Senior Merchandiser'
                ],
              ]
            ],
          ]
        ],
        [
          'name' => 'Operations Support',
          'company' => $epr,
          'departments' => [
            [
              'name' => 'Call Center',
              'sections' => [
                [
                  'name' => 'Learning & Development',
                  'positions' => [
                    [
                      'name' => 'Learning & Development Supervisor'
                    ],
                    [
                      'name' => 'Quality Assurance Officer'
                    ],
                  ]
                ],
                [
                  'name' => 'Sales',
                  'positions' => [
                    [
                      'name' => 'Call Center Section Head'
                    ],
                    [
                      'name' => 'Call Center Team Leader'
                    ],
                  ]
                ],
                [
                  'name' => 'Services',
                  'positions' => [
                    [
                      'name' => 'Services Supervisor'
                    ],
                    [
                      'name' => 'Showroom Staff'
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Call Center Department Head'
                ],
                [
                  'name' => 'Survey & Research Officer'
                ],
              ]
            ],
            [
              'name' => 'Warehouse',
              'sections' => [
                [
                  'name' => 'Branch',
                  'positions' => [
                    [
                      'name' => 'Branch Supervisor'
                    ],
                    [
                      'name' => 'Warehouse Administrator'
                    ],
                    [
                      'name' => 'Warehouse Staff'
                    ],
                  ]
                ],
                [
                  'name' => 'Central',
                  'positions' => [
                    [
                      'name' => 'Warehouse Supervisor'
                    ],
                    [
                      'name' => 'Warehouse Administrator'
                    ],
                    [
                      'name' => 'Warehouse Staff'
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Warehouse Department Head'
                ]
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Operations Support Division Head'
            ],
            [
              'name' => 'Operations Support Data Analyst'
            ],
          ]
        ],
        [
          'name' => 'Technical',
          'company' => $epr,
          'departments' => [
            [
              'name' => 'IT',
              'positions' => [
                [
                  'name' => 'Information Technology Department Head'
                ],
                [
                  'name' => 'Developer'
                ],
              ]
            ]
          ],
        ],
      ];

      foreach($divisions as $division){

        $data_division = new Division();
        $data_division->fill([
          'name' => $division['name'],
          'company' => $division['company'],
        ]);
        $data_division->save();
        if(isset($division['departments']) && count($division['departments']) > 0){

          foreach($division['departments'] as $department){

            $data_department = new Department();
            $data_department->fill([
              'division_id' => $data_division->id,
              'name' => $department['name'],
            ]);
            $data_department->save();
            if(isset($department['sections']) && count($department['sections']) > 0){

              foreach($department['sections'] as $section){

                $data_section = new Section();
                $data_section->fill([
                  'department_id' => $data_department->id,
                  'name' => $section['name'],
                ]);
                $data_section->save();

                if(isset($section['positions']) && count($section['positions']) > 0){
                  foreach($section['positions'] as $position){
                    $data_position = new Position();
                    $data_position->fill([
                      'name' => $position['name'],
                      'section_id' => $data_section->id,
                      'department_id' => $data_department->id,
                      'division_id' => $data_division->id,
                    ]);
                    $data_position->save();
                  }
                }
                
              }

            }

            if(isset($department['positions']) && count($department['positions']) > 0){
              foreach($department['positions'] as $position){
                $data_position = new Position();
                $data_position->fill([
                  'name' => $position['name'],
                  'department_id' => $data_department->id,
                  'division_id' => $data_division->id,
                ]);
                $data_position->save();
              }
            }

          }

        }

        if(isset($division['positions']) && count($division['positions']) > 0){
          foreach($division['positions'] as $position){
            $data_position = new Position();
            $data_position->fill([
              'name' => $position['name'],
              'division_id' => $data_division->id,
            ]);
            $data_position->save();
          }
        }

      }

      // Insert Position
      $positions = [
        [
          // 'division_id' => '',
          // 'department_id' => '',
          // 'section_id' => '',
          'name' => 'Director',
        ],
        [
          // 'division_id' => '',
          // 'department_id' => '',
          // 'section_id' => '',
          'name' => 'Deputy Director',
        ],
      ];

      foreach($positions as $position){
        Position::create($position);
      }

    }
}
