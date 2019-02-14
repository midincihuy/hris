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
          'name' => 'Director',
          'company' => $omni,
          'positions' => [
            [
              'name' => 'Director',
            ],
          ]
        ],
        [
          'name' => 'Director',
          'company' => $epr,
          'positions' => [
            [
              'name' => 'Director',
            ],
            [
              'name' => 'Deputy Director',
              'head' => 'Director',
            ],
          ]
        ],
        [
          'name' => 'Finance',
          'company' => $omni,
          'departments' => [
            [
              'name' => 'Finance & Accounting',
              'positions' => [
                [
                  'name' => 'Billing & Collection Officer',
                  'head' => 'Finance & Accounting Department Head',
                ],
                [
                  'name' => 'Finance & Accounting Department Head',
                  'head' => 'Finance Division Head',
                ],
                [
                  'name' => 'Finance Supervisor',
                  'head' => 'Finance & Accounting Department Head',
                ],
                [
                  'name' => 'General Accounting Supervisor',
                  'head' => 'Finance & Accounting Department Head',
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
                      'head' => 'Finance Division Head',
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
                      'head' => 'Finance Division Head',
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
                      'head' => 'Finance Division Head',
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
                      'head' => 'Finance Division Head',
                    ],
                    [
                      'name' => 'Traffic Supervisor',
                      'head' => 'Traffic Section Head',
                    ],
                  ]
                ]
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Finance Division Head',
              'head' => 'Director',
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
                  'name' => 'GA Supervisor',
                  'head' => 'HRGA Division Head',
                ]
              ]
            ],
            [
              'name' => 'HR',
              'positions' => [
                [
                  'name' => 'HR Officer',
                  'head' => 'HR Supervisor',
                ],
                [
                  'name' => 'HR Operations Officer',
                  'head' => 'HRGA Division Head',
                ],
                [
                  'name' => 'HR Supervisor',
                  'head' => 'HRGA Division Head',
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'HRGA Division Head',
              'head' => 'Director',
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
                      'head' => 'Editing Graphic Production Department Head',
                    ],
                    [
                      'name' => 'Editing Supervisor',
                      'head' => 'Editing Section Head',
                    ],
                    [
                      'name' => 'Video Editor',
                      'head' => 'Editing Section Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Graphic Design',
                  'positions' => [
                    [
                      'name' => 'Graphic Design Section Head',
                      'head' => 'Editing Graphic Production Department Head',
                    ],
                    [
                      'name' => 'Graphic Designer',
                      'head' => 'Graphic Design Section Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Graphic Motion',
                  'positions' => [
                    [
                      'name' => 'Graphic Motion Section Head',
                      'head' => 'Editing Graphic Production Department Head',
                    ],
                    [
                      'name' => 'Motion Designer',
                      'head' => 'Graphic Motion Section Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Multimedia',
                  'positions' => [
                    [
                      'name' => 'Multimedia Designer',
                      'head' => 'Editing Graphic Production Department Head',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Editing Graphic Production Department Head',
                  'head' => 'Programming Division Head',
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
                      'name' => 'Associate Producer',
                      'head' => 'Executive Producer',
                      'head_section' => 'Home Shopping',
                    ],
                    [
                      'name' => 'Executive Producer',
                      'head' => 'Production Department Head',
                    ],
                    [
                      'name' => 'Producer',
                      'head' => 'Executive Producer',
                      'head_section' => 'Home Shopping',
                    ],
                    [
                      'name' => 'Production Assistant',
                      'head' => 'Executive Producer',
                      'head_section' => 'Home Shopping',
                    ],
                  ]
                ],
                [
                  'name' => 'Program',
                  'positions' => [
                    [
                      'name' => 'Associate Producer',
                      'head' => 'Executive Producer',
                      'head_section' => 'Program',
                    ],
                    [
                      'name' => 'Executive Producer',
                      'head' => 'Production Department Head',
                    ],
                    [
                      'name' => 'Producer',
                      'head' => 'Executive Producer',
                      'head_section' => 'Program',
                    ],
                    [
                      'name' => 'Production Assistant',
                      'head' => 'Executive Producer',
                      'head_section' => 'Program',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Production Department Head',
                  'head' => 'Programming Division Head',
                ],
                [
                  'name' => 'Creative',
                  'head' => 'Production Department Head',
                ],
                [
                  'name' => 'Senior Creative',
                  'head' => 'Production Department Head',
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
                      'name' => 'Art Section Head',
                      'head' => 'Production Services Department Head',
                    ],
                    [
                      'name' => 'Set & Property Crew',
                      'head' => 'Set & Property Supervisor',
                    ],
                    [
                      'name' => 'Set & Property Supervisor',
                      'head' => 'Art Section Head',
                    ],
                    [
                      'name' => 'Stylist',
                      'head' => 'Stylist & Make Up Supervisor',
                    ],
                    [
                      'name' => 'Stylist & Make Up Supervisor',
                      'head' => 'Art Section Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Camera & Lighting',
                  'positions' => [
                    [
                      'name' => 'Camera & Lighting Supervisor',
                      'head' => 'Production Services Department Head',
                    ],
                    [
                      'name' => 'Camera Person',
                      'head' => 'Camera & Lighting Supervisor',
                    ],
                    [
                      'name' => 'Lightingman',
                      'head' => 'Camera & Lighting Supervisor',
                    ],
                  ]
                ],
                [
                  'name' => 'Control Room',
                  'positions' => [
                    [
                      'name' => 'Audioman',
                      'head' => 'Control Room Supervisor',
                    ],
                    [
                      'name' => 'CG Operator',
                      'head' => 'Control Room Supervisor',
                    ],
                    [
                      'name' => 'Control Room Supervisor',
                      'head' => 'Production Services Department Head',
                    ],
                    [
                      'name' => 'Switcherman',
                      'head' => 'Control Room Supervisor',
                    ],
                    [
                      'name' => 'VT Operator',
                      'head' => 'Control Room Supervisor',
                    ],
                  ]
                ],
                [
                  'name' => 'Director',
                  'positions' => [
                    [
                      'name' => 'Program Director',
                      'head' => 'Production Services Department Head',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Production Services Department Head',
                  'head' => 'Programming Division Head',
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
                      'name' => 'OAP Crew',
                      'head' => 'OAP Supervisor',
                    ],
                    [
                      'name' => 'OAP Supervisor',
                      'head' => 'Program Services Department Head',
                    ],
                  ]
                ],
                [
                  'name' => 'QC',
                  'positions' => [
                    [
                      'name' => 'QC & Subtitling Officer',
                      'head' => 'QC & Subtitling Supervisor',
                    ],
                    [
                      'name' => 'QC & Subtitling Supervisor',
                      'head' => 'Program Services Department Head',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Library Officer',
                  'head' => 'Program Services Department Head',
                ],
                [
                  'name' => 'Program Services Department Head',
                  'head' => 'Programming Division Head',
                ],
                [
                  'name' => 'Program Services Officer',
                  'head' => 'Program Services Department Head',
                ],
                [
                  'name' => 'Program & Acquisition Officer',
                  'head' => 'Program Services Department Head',
                ],
                [
                  'name' => 'Schedulling Officer',
                  'head' => 'Program Services Department Head',
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
                      'name' => 'Research & Development Officer',
                      'head' => 'Research & Development Section Head',
                    ],
                    [
                      'name' => 'Research & Development Section Head',
                      'head' => 'Programming Division Head',
                    ],
                  ]
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Programming Division Head',
              'head' => 'Director',
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
                  'name' => 'Marketing Department Head',
                  'head' => 'Sales & Marketing Division Head',
                ],
                [
                  'name' => 'Senior Marketing Officer',
                  'head' => 'Marketing Department Head',
                ],
              ]
            ],
            [
              'name' => 'Marketing Communication',
              'positions' => [
                [
                  'name' => 'Digital Marketing Officer',
                  'head' => 'Promotion Supervisor',
                ],
                [
                  'name' => 'Marketing Communication Department Head',
                  'head' => 'Sales & Marketing Division Head',
                ],
                [
                  'name' => 'Marketing Communication Officer',
                  'head' => 'Marketing Communication Department Head',
                ],
                [
                  'name' => 'Promotion Officer',
                  'head' => 'Promotion Supervisor',
                ],
                [
                  'name' => 'Promotion Supervisor',
                  'head' => 'Marketing Communication Department Head',
                ],
              ]
            ],
            [
              'name' => 'Sales',
              'positions' => [
                [
                  'name' => 'Account Executive',
                  'head' => 'Account Manager',
                ],
                [
                  'name' => 'Account Manager',
                  'head' => 'Sales & Marketing Division Head',
                ],
                [
                  'name' => 'Sales Department Head',
                  'head' => 'Sales & Marketing Division Head',
                ],
                [
                  'name' => 'Sales Support Officer',
                  'head' => 'Sales Department Head',
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Sales & Marketing Division Head',
              'head' => 'Director',
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
                  'name' => 'Information Technology Department Head',
                  'head' => 'Technical Division Head',
                ],
                [
                  'name' => 'IT Support',
                  'head' => 'IT Support & Network Section Head',
                ],
                [
                  'name' => 'IT Support & Network Section Head',
                  'head' => 'Information Technology Department Head',
                ],
                [
                  'name' => 'Senior Developer',
                  'head' => 'Information Technology Department Head',
                ],
              ]
            ],
            [
              'name' => 'Technical Operation',
              'positions' => [
                [
                  'name' => 'Technical Operation Department Head',
                  'head' => 'Technical Division Head',
                ],
                [
                  'name' => 'Technical Support Engineer',
                  'head' => 'Technical Support Section Head',
                ],
                [
                  'name' => 'Technical Support Section Head',
                  'head' => 'Technical Operation Department Head',
                ],
              ]
            ],
            [
              'name' => 'Transmission',
              'positions' => [
                [
                  'name' => 'Transmission Department Head',
                  'head' => 'Technical Division Head',
                ],
                [
                  'name' => 'Transmission Engineer',
                  'head' => 'Transmission Supervisor',
                ],
                [
                  'name' => 'Transmission Supervisor',
                  'head' => 'Transmission Department Head',
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Technical Division Head',
              'head' => 'Director',
            ]
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
                  'name' => 'Finance & Accounting Department Head',
                  'head' => 'Finance Division Head',
                ],
                [
                  'name' => 'Finance & Accounting Section Head',
                  'head' => 'Finance & Accounting Department Head',
                ],
                [
                  'name' => 'Finance & Accounting Officer',
                  'head' => 'Finance & Accounting Section Head',
                ],
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Finance Division Head',
              'head' => 'Director',
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
                      'name' => 'Digital Marketing Officer',
                      'head' => 'Digital Marketing Section Head',
                    ],
                    [
                      'name' => 'Digital Marketing Section Head',
                      'head' => 'Merchandising & Marketing Division Head',
                    ],
                    [
                      'name' => 'Social Media Officer',
                      'head' => 'Digital Marketing Section Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Non Digital',
                  'positions' => [
                    [
                      'name' => 'Promotion Officer',
                      'head' => 'Promotion Section Head',
                    ],
                    [
                      'name' => 'Promotion Section Head',
                      'head' => 'Merchandising & Marketing Division Head',
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
                      'name' => 'Merchandising Administrator',
                      'head' => 'Grid Supervisor',
                      'head_section' => 'Grid',
                    ],
                    [
                      'name' => 'Grid Supervisor',
                      'head' => 'Merchandising Department Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Merchandiser',
                  'positions' => [
                    [
                      'name' => 'Merchandising Administrator',
                      'head' => 'Merchandiser',
                      'head_section' => 'Merchandiser',
                    ],
                    [
                      'name' => 'Merchandiser',
                      'head' => 'Merchandising Department Head',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'E-Commerce Administrator',
                  'head' => 'Merchandising Department Head',
                ],
                [
                  'name' => 'Merchandising & Marketing Division Head',
                  'head' => 'Deputy Director'
                ],
                [
                  'name' => 'Merchandising Department Head',
                  'head' => 'Merchandising & Marketing Division Head'
                ],
                [
                  'name' => 'Senior Merchandiser',
                  'head' => 'Merchandising Department Head',
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
                      'name' => 'Learning & Development Supervisor',
                      'head' => 'Call Center Department Head',
                    ],
                    [
                      'name' => 'Quality Assurance Officer',
                      'head' => 'Learning & Development Supervisor',
                    ],
                  ]
                ],
                [
                  'name' => 'Sales',
                  'positions' => [
                    [
                      'name' => 'Call Center Section Head',
                      'head' => 'Call Center Department Head',
                    ],
                    [
                      'name' => 'Call Center Team Leader',
                      'head' => 'Call Center Section Head',
                    ],
                  ]
                ],
                [
                  'name' => 'Services',
                  'positions' => [
                    [
                      'name' => 'Services Supervisor',
                      'head' => 'Call Center Department Head',
                    ],
                    [
                      'name' => 'Showroom Staff',
                      'head' => 'Services Supervisor',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Call Center Department Head',
                  'head' => 'Operations Support Division Head',
                ],
                [
                  'name' => 'Survey & Research Officer',
                  'head' => 'Call Center Department Head',
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
                      'name' => 'Branch Supervisor',
                      'head' => 'Warehouse Department Head',
                    ],
                    [
                      'name' => 'Warehouse Administrator',
                      'head' => 'Branch Supervisor',
                    ],
                    [
                      'name' => 'Warehouse Staff',
                      'head' => 'Branch Supervisor',
                    ],
                  ]
                ],
                [
                  'name' => 'Central',
                  'positions' => [
                    [
                      'name' => 'Warehouse Supervisor',
                      'head' => 'Warehouse Department Head',
                    ],
                    [
                      'name' => 'Warehouse Administrator',
                      'head' => 'Warehouse Supervisor',
                    ],
                    [
                      'name' => 'Warehouse Staff',
                      'head' => 'Warehouse Supervisor',
                    ],
                  ]
                ],
              ],
              'positions' => [
                [
                  'name' => 'Warehouse Department Head',
                  'head' => 'Operations Support Division Head',
                ]
              ]
            ],
          ],
          'positions' => [
            [
              'name' => 'Operations Support Division Head',
              'head' => 'Deputy Director',
            ],
            [
              'name' => 'Operations Support Data Analyst',
              'head' => 'Operations Support Division Head',
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
                  'name' => 'Information Technology Department Head',
                  'head' => 'Technical Division Head',
                ],
                [
                  'name' => 'Developer',
                  'head' => 'Information Technology Department Head',
                ],
              ]
            ]
          ],
          'positions' => [
            [
              'name' => 'Technical Division Head',
              'head' => 'Deputy Director',
            ],
          ]
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
      // Update Parent ID
      foreach($divisions as $division){
        $data_division = App\Division::where('name', $division['name'])->where('company', $division['company'])->first();
        if(isset($division['positions']) && count($division['positions']) > 0){
            foreach($division['positions'] as $position){
                if(isset($position['head'])){
                    $data_position = App\Position::where('name', $position['name'])->where('division_id',$data_division->id)->first();
                    $data_position->parent_id = App\Position::with('division')->where('name', $position['head'])->get()->where('company',$data_division->company)->first()->id;
                    $data_position->save();
                }
            }
        }
        if(isset($division['departments']) && count($division['departments']) > 0){
            foreach($division['departments'] as $department){
                $data_department = App\Department::where('name', $department['name'])->where('division_id', $data_division->id)->first();
                if(isset($department['positions']) && count($department['positions']) > 0){
                    foreach($department['positions'] as $position){
                        if(isset($position['head'])){
                            $data_position = App\Position::where('name', $position['name'])->where('division_id',$data_division->id)->where('department_id', $data_department->id)->first();
                            $data_position->parent_id = App\Position::with('division')->where('name', $position['head'])->get()->where('company',$data_division->company)->first()->id;
                            $data_position->save();
                        }
                    }
                }
                if(isset($department['sections']) && count($department['sections']) > 0){
                    foreach($department['sections'] as $section){
                        $data_section = App\Section::where('name', $section['name'])->where('department_id', $data_department->id)->first();
                        if(isset($section['positions']) && count($section['positions']) > 0){
                            foreach($section['positions'] as $position){
                                if(isset($position['head'])){
                                    $data_position = App\Position::where('name', $position['name'])->where('division_id',$data_division->id)->where('department_id', $data_department->id)->where('section_id', $data_section->id)->first();
                                    if(isset($position['head_section'])){
                                      $data_position->parent_id = App\Position::with('division')->where('name', $position['head'])->where('section_id', App\Section::where('name', $position['head_section'])->first()->id)->get()->where('company',$data_division->company)->first()->id;
                                    }else{
                                        $data_position->parent_id = App\Position::with('division')->where('name', $position['head'])->get()->where('company',$data_division->company)->first()->id;
                                    }
                                    $data_position->save();
                                }
                            }
                        }
                    }
                }

            }
        }
      }
    }
}
