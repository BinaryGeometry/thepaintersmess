# moved to a fresh branch

## still need to update the put to a post to make the interia scaffolding work with images

> I want to use ai to write the tests. We need tests to make the content work
>
>We Are Uncertain of the UI although we now have a fairly set of ux goals as well as some core functionality for the
> beta test release.
>
>We already have a way to add paints, with some hardcoded system_item value Objeccts
>
> [note : skipped at this point, click here to see how this part was completed or follow along in the order we approached things]
>
> We need Minis and Units of Minis sorted under system_items [gamesystem, faction, regiment]
>
> We need Recipes and Steps In Recipe against Factions, and Faction Detachments, and Armys, and Units and Minis
>
> We need to be able to filter Recipes, Units, etc by Game System
>
> Each view in the Recipe section should have a quick filter of paints that are currently used in that
> gamesystem , these will be automatically subdivided in lists (potentially some day user configurable). For now these
> lists will be
> * Your Paints
> * Your Paints you use in this gamesystem
> * Your Paints you use in this faction and detachment
> * Your Paints you use in this unit and mini
> * Your leftover Paints
>
> You can add a paint at any time.
>
> When you first create the faction you begin with a completely empty screen. There
> is the option to create a PaintableAttribute or pre populate a set of sensible defaults

Thinking out loud for a moment the data structure for a !!goblin leader!!

gamesystems : [
40K: [
factions: [
Space Marines [
Blood Angels []
Dark Angels []
Apothacary
]
Orks []
Necrons []
Plague Marines []
]
]
Warhammer [
Night Goblins [
1 prime: Chaos Black
robes: Chaos Black

            2 skin: Goblin Green
            
            3 staff: Scab Red
            
            4 spear binding: Bubonic Brown
                belt: Bubonic Brown
                teeth Bubonic Brown
            
            5 Shield Livery: Sunburst Yellow (story here, how to add a white step)

            6 Metal:
                Spear:
                Shield Rim: 
            
            Leader [
                Shield Livery
                    Bad Moon Yellow
                continues 
                Staff: continue Scab Red
                    2: Suigg Red
                    3: Fast Red
            ]
        ]       
        Dwarves [
        ]
        Skeletons []
        Elves []
    ]

        
    Warhammer

]

```
"gamesystems" : [
    {
        "name": "40K" [
        "factions: [
            {
                "name": "Space Marines": {
                "detachments: ["Blood Angel", "Dark Angel"],
                "units": []
            },
            {
                "name": "Orks": {
                "detachments: ["Blood Axe", "Bad Moon"],
                "units": []
            },
            {
                "name": "Necrons": {
                "detachments: [],
                "units": []
            },
            {
                "name": "Plague Marines": {
                "detachments: [],
                "units": []
            },
        ]
    },
    {
    "name": "Warhammer" [
    "factions: [
        {
            "name": "Chaos": {
            "detachments: [],
            "units": [
                {
                    "name":"Skeletons"
                }
            ],
            "alignment": "destruction"
        },
        {
            "name": "Dwarves": {
            "detachments: [""],
            "units": [],
            "alignment": "destruction"
        },
        {
            "name": "Elves": {
            "detachments: [""],
            "units": [
                {
                    {
                        "name": "Wood Eleves",
                        "faction_default": true
                        "recipe": {}
                    }
                }
            ],
            "alignment": "alliance"
        },
        {
            "name": "Night Goblins": {
            "alignment": "destruction",
            "detachments: [""],
            "units": [
                    {
                        "name": "Spearmen",
                        "faction_default": true,
                        "recipe": {
                            "note": "One Recipe Per Unit. Ingredients are like paint areas, Paints are like seasonings"
                            "level": "tabletop"
                            "steps": {
                                "1": [
                                    {
                                        "ingredient": "prime", 
                                        "paint": "Chaos Black"
                                    },
                                    {
                                       "ingredient": "robes", 
                                        "paint": "Chaos Black"
                                    },
                                ],
                                "2": [
                                    {
                                       "ingredient": "skin", 
                                        "paint": "Goblin Green"
                                    },
                                ],
                                "3": [
                                    {
                                       "ingredient": "spear staff", 
                                        "paint": "Scab Red"
                                    },
                                ],
                                "4": [
                                    {
                                       "ingredient": "spear binding", 
                                        "paint": "Bubonic Brown",
                                        "material": "leather"
                                    },
                                    {
                                       "ingredient": "belt", 
                                        "paint": "Bubonic Brown",
                                        "material": "leather"
                                    },
                                    {
                                       "ingredient": "teeth", 
                                        "paint": "Bubonic Brown",
                                    },            
                                ],
                                "5": [
                                    {
                                       "ingredient": "Shield Livery", 
                                        "paint": "Sunburst Yellow",
                                    },
                                ],
                                "6": [
                                    {
                                       "ingredient": "Shield Rim", 
                                        "paint": "Chainmail",
                                        "material": "metal"
                                    },
                                    {
                                       "ingredient": "Spear Tip", 
                                        "paint": "Chainmail",
                                        "material": "metal"
                                    },
                                ],
                               
                    }
            ],
        },
    ]
]
```

## Created that in a file storage/app/private/interface.json

$ php artisan serve
php artisan make:model -mrc Recipe
php artisan make:model -m Step

#

https://laracasts.com/discuss/channels/vite/using-background-images-in-tailwind-vite-laravel-environment


