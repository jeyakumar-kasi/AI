# -*- coding: utf-8 -*-
"""
Created on Tue Dec  7 23:05:49 2021

@author: Jai K
"""
import re
import sys
import math

main_city_percent = 60

def get_var_name(s):
    return re.sub('[\W]+', '', re.sub('[\s]+', '_', s)).lower() #s.strip().lower().replace('-', ' ').replace(' ', '_')

def is_main_city(max_pop, pop):
    pop = int(pop); max_pop = int(max_pop)
    return round((100/max_pop) * pop) >= main_city_percent or pop >= 250000

def extract_number(s):
    return int(re.findall('\d+', s.replace(',', ''))[0])
    
def s():
    s = """
    1	Visakhapatnam	Visakhapatnam	2,035,922	1,345,938	1865	98
    2	Vijayawada	Krishna	1,179,395	900,061	1888	64
    3	Guntur	Guntur	743,354	514,461	1866	57
    4	Nellore	SPSR Nellore	547,621	404,775	1866	54
    5	Kurnool	Kurnool	457,633	269,122	1866	52
    6	Kakinada	East Godavari	384,128	335,299	1866	50
    7	Rajamahendravaram	East Godavari	376,333	374,721	1865	50
    8	Kadapa	YSR Kadapa	344,893	148,039	1868	50
    9	Tirupati	Chittoor	295,323	244,990	1886	50
    10	Anantapuram	Anantapuram	267,161	243,143	1869	50
    11	Vizianagaram	Vizianagaram	228,720	176,023	1888	50
    12	Eluru	West Godavari	218,020	215,804	1866	50
    13	Nandyal	Kurnool	211,424	154,324	1899	42
    14	Ongole	Prakasam	208,344	153,829	1876	50
    15	Adoni	Kurnool	184,625	146,458	1865	42
    16	Madanapalle	Chittoor	180,180	107,449	1961	35
    17	Machilipatnam	Krishna	169,892	179,353	1866	50
    18	Srikakulam	Srikakulam	165,735	117,320	1856	50
    19	Tenali	Guntur	164,937	153,756	1912	40
    20	Proddatur	YSR Kadapa	163,970	150,309	1915	41
    21	Chittoor	Chittoor	160,722	152,654	1917	50
    22	Hindupur	Anantapuram	151,677	125,074	1920	38
    23	Kadiri (URBAN) AND (RURAL)	Anantapuram district	1,51,203	1,20,325	1963	36
    24	Bhimavaram	West Godavari	146,961	142,064	1948	39
    25	Gudivada	Krishna	134,812	113,054	1937	39
    26	Tadepalligudem	West Godavari	130,348	102,622	1958	40
    27	Guntakal	Anantapuram	126,270	117,103	1948	37
    28	Dharmavaram	Anantapuram	121,874	103,357	1964	40
    29	Narasaraopet	Guntur	117,489	95,349	1915	38
    30	Tadipatri	Anantapur	108,421	86,843	1920	36
    31	Mangalagiri	Guntur	107,197	63,349	1969	35
    32	Chilakaluripet	Guntur	101,398	91,656	1964	38
    
    """
    
    state_code = 'TS'        

#City	Area (KM 2)	Population (2021)	Population (2020)	Population (2011)    
    s = """

1	Hyderabad	Hyderabad Medchal–Malkajgiri Ranga Reddy Sangareddy	Hyderabad Ranga Reddy	Greater M.Corp	6,993,262	650.00	[7]
2	Warangal[a]	Hanamkonda Warangal	Warangal	Greater M.Corp	830,281	407.77	[8][9]
3	Nizamabad	Nizamabad	Nizamabad	M.Corp	311,152	49.90	[10][11]
4	Khammam[a]	Khammam	Khammam	M.Corp	305,000	94.45	[12]
5	Karimnagar	Karimnagar	Karimnagar	M.Corp	297,447	40.50	[13][14]
6	Ramagundam	Peddapalli	Karimnagar	M.Corp	252,308	93.87	[13][15]
7	Mahabubnagar[a]	Mahabubnagar	Mahabubnagar	M Special Grade	222,573	98.64	[16]
8	Nalgonda[a]	Nalgonda	Nalgonda	MGrade-1	154,326	105.00	[17][2]
9	Adilabad[a]	Adilabad	Adilabad	MGrade-1	139,383	35.50	[18]
10	Suryapet[a]	Suryapet	Nalgonda	MGrade-1	139,000	24.00	[19]
11	Siddipet[a]	Siddipet	Medak district	MGrade-1	114,091	35.00	[20]
12	Miryalaguda	Nalgonda	Nalgonda	MGrade-1	109,891	28.36	[21]
13	Jagtial	Jagtial	Karimnagar	MGrade-1	103,930	45.00	[13][22]
14	Mancherial	Mancherial	Adilabad	MGrade-1	89,935	90.00	[23]
15	Nirmal	Nirmal	Adilabad	MGrade-2	88,433	32.06	[23][24]
16	Sircilla	Rajanna Sircilla	Karimnagar	MGrade-2	83,186	55.87	[13]
17	Kamareddy	Kamareddy	Nizamabad	MGrade-2	80,315	14.10	[10]
18	Palwancha	Bhadradri Kothagudem	Khammam	MGrade-2	80,199	26.38	[25]
19	Kothagudem	Bhadradri Kothagudem	Khammam	MGrade-1	79,819	32.10	[25]
20	Bodhan	Nizamabad	Nizamabad	MGrade-2	77,573	35.40	[10]
21	Sangareddy	Sangareddy	Medak	MGrade-1	72,344	13.70	[26]
22	Metpally	Jagtial	Karimnagar	MGrade-1	71,984	28.50	[13]
23	Zahirabad	Sangareddy	Medak	MGrade	71,166	21.78	[26]
24	Meerpet Jillelguda	Ranga Reddy	Ranga Reddy	M.Corp	66,982	4.20	[27]
25	Korutla	Jagtial	Karimnagar	MGrade-1	66,504	34.10	[13]
26	Tandur	Vikarabad	Rangareddy	MGrade-2	65,115	21.50	[28]
27	Badangpet	Ranga Reddy	Ranga Reddy	M.Corp	64,659	74.56	[29]
28	Kodad	Suryapet	Nalgonda	MGrade-2	64,234	31.19	[30]
29	Armur	Nizamabad	Nizamabad	MGrade	64,023	35.55	[10]
30	Gadwal	Jogulamba Gadwal	Mahabubnagar	MGrade-2	63,177	33.46	[31]
31	Wanaparthy	Wanaparthy	Mahabubnagar	MGrade	60,949	27.03	[31]
32	Kagaznagar	Komaram Bheem	Adilabad	MGrade	57,583	8.31	[23]
33	Bellampalle	Komaram Bheem	Adilabad	MGrade	55,841	35.06	[23]
34	Khanapuram Haveli	Khammam	Khammam	CT	53,442	12.70	[25]
35	Bhuvanagiri	Y. Bhuvanagiri	Nalgonda	MGrade-2	53,339	76.537	[30]
36	Vikarabad	Vikarabad	Rangareddy	MGrade-2	53,143	31.70	[28]
37	Jangaon	Jangaon	Warangal	MGrade-2	52,394	17.49	[32]
38	Mandamarri	Mancherial	Adilabad	MGrade	52,352	38.84	[23]
39	Peerzadiguda	Medchal-Malkajgiri	Rangareddy	M.Corp	51,689	10.05	[33]
40	Bhadrachalam	Bhadradri Kothagudem	Khammam	CT	50,087	12.00	[25]
41	Bhainsa	Nirmal	Adilabad	MGrade	49,764	[23]
42	Boduppal	Medchal-Malkajgiri	Rangareddy	M.Corp	48,255	[34]
43	Jawaharnagar	Medchal-Malkajgiri	Rangareddy	M.Corp	48,216	[35]
44	Medak	Medak	Medak	MGrade-2	46,880	[26]
45	Shamshabad	Rangareddy	Rangareddy	MGrade-2	44,651	[36]
46	Mahabubabad	Mahabubabad	Warangal	MGrade-2	42,851	[32]
47	Bhupalpally	Jayashankar Bhupalpally	Warangal	Nagara Panchayat	42,387	[32]
48	Narayanpet	Narayanpet	Mahabubnagar	MGrade	41,752	[31]
49	Peddapalli	Peddapalli	Karimnagar	Nagara Panchayat	41,171	[13]
50	Dundigal	Medchal-Malkajgiri	Rangareddy	MGrade	40,817	[37]
51	Huzurnagar	Suryapet	Nalgonda	MGrade	35,850	[30]
52	Medchal	Medchal-Malkajgiri	Rangareddy	MGrade	35,611	[28]
53	Bandlaguda Jagir	Rangareddy	Rangareddy	M.Corp	35,154	[38]
54	Kyathanpally	Mancherial	Adilabad	MGrade	32,235	[23]
55	Manuguru	Bhadradri Kothagudem	Khammam	MGrade	32,091	[25]
56	Naspur	Mancherial	Adilabad	MGrade	31,244	[23]
57	Narsampet	Warangal	Warangal	CT	30,963	[32]
58	Devarakonda	Nalgonda	Nalgonda	MGrade	29,731	[30]
59	Dubbaka	Siddipet	Medak	MGrade	29,600	[26]
60	Nakrekal	Nalgonda	Nalgonda	MGrade	29,126	[30]
61	Banswada	Kamareddy	Nizamabad	MGrade	28,384	[10]
62	Kalwakurthy	Nagarkurnool	Mahabubnagar	MGrade	28,060	[31]
63	Nagar Kurnool	Nagar Kurnnol	Mahabubnagar	Nagara Panchayat	26,801	[31]
64	Parigi	Vikarabad	Rangareddy	MGrade	26,000	[citation needed]
65	Thumkunta	Medchal-Malkajgiri	Rangareddy	MGrade	24,187	[39]
66	Neredcherla	Suryapet	Nalgonda	MGrade	25,678	[30]
67	Nagaram	Medchal-Malkajgiri	Rangareddy	MGrade	25,521	[40]
68	Gajwel	Siddipet	Medak	MGrade	24,961	[26]
69	Chennur	Mancherial	Adilabad	MGrade	23,579	[23]
70	Asifabad	Komaram Bheem	Adilabad	CT	23,059	[23]
71	Madhira	Khammam	Khammam	MGrade	22,716	[25]
72	Ghatkesar	Medchal-Malkajgiri	Rangareddy	MGrade	22,657	[41]
73	Kompally	Medchal-Malkajgiri	Rangareddy	MGrade	22,377	[42]
74	Dasnapur	Adilabad	Adilabad	CT	22,216	[23]
75	Sarapaka	Bhadradri Kothagudem	Khammam	CT	22,149	[25]
76	Husnabad	Siddipet	Karimnagar	MGrade	22,099	[43]
77	Pocharam	Medchal-Malkajgiri	Rangareddy	MGrade	21,946	[44]
78	Dammaiguda	Medchal-Malkajgiri	Rangareddy	MGrade	21,452	[45]
79	Achampet	Nagarkurnool	Mahabubnagar	MGrade	20,721	[31]


    """
    
    n = 0
    cities = {}
    for line in s.splitlines():
        if line.lstrip():
            if line[0] == '(': continue
            
            n += 1
            #ine = str(n) + '.' + line
            # m = re.findall(r'^([\w\s\(\)]+)\t(.*?)\s+([,\d]+)', line.lstrip())
            m = re.findall(r'^([0-9\w.\s\(\)\[\]\/\-]+)\t([\w\s\(\)\-,]+)\s(.*?)\s+([,\d]+)', line.lstrip())
            print(n, m)
            
            m = m[0]
            s = m[0].split('\t')
            # city_name = m[0].strip()
            # city_name = m[1].strip()
            city_name = s[1]
            try:
                pop = extract_number(m[2])#m[1].split('\t')[2]) #(m[2])
            except IndexError:
                print(city_name, m[3]) 
                pop = extract_number(m[3])
            
            cities[get_var_name(city_name)] = (city_name, pop)
            # cities[get_var_name(city_name)] = (city_name, pop)
    
    
    # cities = {code.split()[0]: (city[0].split('\t')[0], city[0].split('\t')[3]) for code, city in cities.items()}
    # for code, city in cities.items():              
    #     print(code, city)
    # sys.exit()
    
    count = 0
    q_count = 0       
    main_sql = 'INSERT INTO `ha_cities` (`id`, `state_code`, `city_code`, `city_name`, `city_order`, `city_type`, `posts_count`, `alias_names`, `city_lang_codes`, `city_color`, `description`, `is_main_city`, `status`) VALUES '
    cities = sorted(cities.items(), key=lambda item: int(item[1][1]), reverse=True)
    max_pop = math.ceil(sum(city[1][1] for city in cities) / len(cities))
    
    for i, (code, item) in enumerate(cities, 1):
        is_main = is_main_city(max_pop, item[1])
        print(i, code, item[0], item[1], is_main)
        
        if (count % 10 == 0):
            sql = main_sql
        sql += "(NULL, '{}', '{}', '{}', NULL, '', '0', NULL, NULL, NULL, NULL, '{}', '1'),".format(
            state_code,
            code,
            item[0],
            '1' if bool(is_main) else '0'
        )
        count += 1
        if (count % 10 == 0) or i == len(cities):
            q_count += 1
            sql = sql.rstrip(',') + ';'
            #print('\n -- Query: ', q_count, '\n-- ', '-' * 40); print('\n', sql, '\n')
        
        

def ss():
    #Code	District	Headquarters	Population (2011)[2]	Area (km²)
    s = """
    AJ	Anjaw	Hawai	21,089	6,190
    CH	Where is Changlang	Changlang	147,951	4,662
    EK	Where is East Kameng	Seppa	78,413	4,134
    ES	Where is East Siang	Pasighat	99,019	4,005
    EL	Where is Lohit	Tezu	145,538	2,402
    LB	Where is Lower Subansiri	Ziro	82,839	3,460
    PA	Where is Papum Pare	Yupia	176,385	2,875
    TA	Where is Tawang	Tawang Town	49,950	2,085
    TI	Where is Tirap	Khonsa	111,997	2,362
    UD	Where is Lower Dibang Valley	Roing	53,986	3,900
    US	Where is Upper Siang	Yingkiong	33,146	6,188
    UB	Where is Upper Subansiri	Daporijo	83,205	7,032
    WK	Where is West Kameng	Bomdila	87,013	7,422
    WS	Where is West Siang	Along	112,272	8,325
    Where is Upper Dibang Valley	Anini	7,948	9,129
    Kurung Kumey	Koloriang	89,717	8,818  
    """
    
    cities = {}
    for line in s.splitlines():
        if line.lstrip():
            m = re.findall(r'^([\w\s]{2,})\t([\w\s]+)\t(.*?)\s+([,\d]+)', line.lstrip())
        
            m = m[0]
            s = m[0].split('\t')
            city_name = (s[1] if len(s) > 1 else s[0]).replace('Where is', '').strip()
            cities[get_var_name(city_name)] = (city_name, extract_number(m[2]))
    
    cities = sorted(cities.items(), key=lambda item: item[1][1], reverse=True)
    max_pop = cities[0][1][1]
    for i, (code, item) in enumerate(cities, 1):
        print(i, code, item, is_main_city(max_pop, item[1]))


s()