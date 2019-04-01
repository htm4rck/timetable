--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: happyland; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA happyland;


ALTER SCHEMA happyland OWNER TO postgres;

--
-- Name: SCHEMA happyland; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA happyland IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: employee; Type: TABLE; Schema: happyland; Owner: postgres
--

CREATE TABLE happyland.employee (
    idemployee smallint NOT NULL,
    paternal character varying(16) NOT NULL,
    maternal character varying(16) NOT NULL,
    names character varying(32) NOT NULL,
    login character varying(16) NOT NULL,
    pass character varying(256) NOT NULL,
    weekly_hours smallint NOT NULL,
    extra_hours smallint NOT NULL,
    extra_minutes smallint NOT NULL,
    gender character varying(1) NOT NULL,
    dni character varying(8) NOT NULL,
    mobile character varying(10) NOT NULL
);


ALTER TABLE happyland.employee OWNER TO postgres;

--
-- Name: manager; Type: TABLE; Schema: happyland; Owner: postgres
--

CREATE TABLE happyland.manager (
    idmanager smallint NOT NULL,
    paternal character varying(16) NOT NULL,
    maternal character varying(16) NOT NULL,
    names character varying(32) NOT NULL,
    login character varying(16) NOT NULL,
    pass character varying(256) NOT NULL
);


ALTER TABLE happyland.manager OWNER TO postgres;

--
-- Name: manager_idmanager_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.manager_idmanager_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.manager_idmanager_seq OWNER TO postgres;

--
-- Name: manager_idmanager_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.manager_idmanager_seq OWNED BY happyland.manager.idmanager;


--
-- Name: personal_horas_extras_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.personal_horas_extras_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.personal_horas_extras_seq OWNER TO postgres;

--
-- Name: personal_horas_extras_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.personal_horas_extras_seq OWNED BY happyland.employee.extra_hours;


--
-- Name: personal_horas_semanales_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.personal_horas_semanales_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.personal_horas_semanales_seq OWNER TO postgres;

--
-- Name: personal_horas_semanales_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.personal_horas_semanales_seq OWNED BY happyland.employee.weekly_hours;


--
-- Name: personal_idpersonal_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.personal_idpersonal_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.personal_idpersonal_seq OWNER TO postgres;

--
-- Name: personal_idpersonal_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.personal_idpersonal_seq OWNED BY happyland.employee.idemployee;


--
-- Name: personal_min_extras_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.personal_min_extras_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.personal_min_extras_seq OWNER TO postgres;

--
-- Name: personal_min_extras_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.personal_min_extras_seq OWNED BY happyland.employee.extra_minutes;


--
-- Name: timetable_employee; Type: TABLE; Schema: happyland; Owner: postgres
--

CREATE TABLE happyland.timetable_employee (
    idtimetable_employee smallint NOT NULL,
    day smallint NOT NULL,
    start_hour smallint NOT NULL,
    start_minute smallint NOT NULL,
    number_hours character varying NOT NULL,
    number_minutes smallint NOT NULL,
    idemployee smallint NOT NULL
);


ALTER TABLE happyland.timetable_employee OWNER TO postgres;

--
-- Name: tabletime_employee_day_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.tabletime_employee_day_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.tabletime_employee_day_seq OWNER TO postgres;

--
-- Name: tabletime_employee_day_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.tabletime_employee_day_seq OWNED BY happyland.timetable_employee.day;


--
-- Name: tabletime_employee_idemployee_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.tabletime_employee_idemployee_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.tabletime_employee_idemployee_seq OWNER TO postgres;

--
-- Name: tabletime_employee_idemployee_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.tabletime_employee_idemployee_seq OWNED BY happyland.timetable_employee.idemployee;


--
-- Name: tabletime_employee_idtabletime_employee_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.tabletime_employee_idtabletime_employee_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.tabletime_employee_idtabletime_employee_seq OWNER TO postgres;

--
-- Name: tabletime_employee_idtabletime_employee_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.tabletime_employee_idtabletime_employee_seq OWNED BY happyland.timetable_employee.idtimetable_employee;


--
-- Name: tabletime_employee_number_minutes_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.tabletime_employee_number_minutes_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.tabletime_employee_number_minutes_seq OWNER TO postgres;

--
-- Name: tabletime_employee_number_minutes_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.tabletime_employee_number_minutes_seq OWNED BY happyland.timetable_employee.number_minutes;


--
-- Name: tabletime_employee_start_hour_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.tabletime_employee_start_hour_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.tabletime_employee_start_hour_seq OWNER TO postgres;

--
-- Name: tabletime_employee_start_hour_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.tabletime_employee_start_hour_seq OWNED BY happyland.timetable_employee.start_hour;


--
-- Name: tabletime_employee_start_minute_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.tabletime_employee_start_minute_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.tabletime_employee_start_minute_seq OWNER TO postgres;

--
-- Name: tabletime_employee_start_minute_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.tabletime_employee_start_minute_seq OWNED BY happyland.timetable_employee.start_minute;


--
-- Name: timetable_weekly; Type: TABLE; Schema: happyland; Owner: postgres
--

CREATE TABLE happyland.timetable_weekly (
    idtimetable_weekly smallint NOT NULL,
    description character varying(256) NOT NULL,
    date date NOT NULL,
    estate character varying(2) NOT NULL,
    idmanager smallint NOT NULL
);


ALTER TABLE happyland.timetable_weekly OWNER TO postgres;

--
-- Name: timetable_weekly_idmanager_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_weekly_idmanager_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_weekly_idmanager_seq OWNER TO postgres;

--
-- Name: timetable_weekly_idmanager_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_weekly_idmanager_seq OWNED BY happyland.timetable_weekly.idmanager;


--
-- Name: timetable_weekly_idtimetable_weekly_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_weekly_idtimetable_weekly_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_weekly_idtimetable_weekly_seq OWNER TO postgres;

--
-- Name: timetable_weekly_idtimetable_weekly_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_weekly_idtimetable_weekly_seq OWNED BY happyland.timetable_weekly.idtimetable_weekly;


--
-- Name: timetable_work; Type: TABLE; Schema: happyland; Owner: postgres
--

CREATE TABLE happyland.timetable_work (
    idtimetable_work smallint NOT NULL,
    day character varying(1) NOT NULL,
    start_hour smallint NOT NULL,
    start_minute smallint NOT NULL,
    number_hours smallint NOT NULL,
    number_minutes smallint NOT NULL,
    idemployee smallint NOT NULL,
    idtimetable_weekly smallint NOT NULL
);


ALTER TABLE happyland.timetable_work OWNER TO postgres;

--
-- Name: timetable_work_idtimetable_employee_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_idtimetable_employee_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_idtimetable_employee_seq OWNER TO postgres;

--
-- Name: timetable_work_idtimetable_employee_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_idtimetable_employee_seq OWNED BY happyland.timetable_work.idemployee;


--
-- Name: timetable_work_idtimetable_weekly_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_idtimetable_weekly_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_idtimetable_weekly_seq OWNER TO postgres;

--
-- Name: timetable_work_idtimetable_weekly_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_idtimetable_weekly_seq OWNED BY happyland.timetable_work.idtimetable_weekly;


--
-- Name: timetable_work_idtimetable_work_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_idtimetable_work_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_idtimetable_work_seq OWNER TO postgres;

--
-- Name: timetable_work_idtimetable_work_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_idtimetable_work_seq OWNED BY happyland.timetable_work.idtimetable_work;


--
-- Name: timetable_work_number_hours_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_number_hours_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_number_hours_seq OWNER TO postgres;

--
-- Name: timetable_work_number_hours_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_number_hours_seq OWNED BY happyland.timetable_work.number_hours;


--
-- Name: timetable_work_number_minutes_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_number_minutes_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_number_minutes_seq OWNER TO postgres;

--
-- Name: timetable_work_number_minutes_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_number_minutes_seq OWNED BY happyland.timetable_work.number_minutes;


--
-- Name: timetable_work_start_hour_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_start_hour_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_start_hour_seq OWNER TO postgres;

--
-- Name: timetable_work_start_hour_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_start_hour_seq OWNED BY happyland.timetable_work.start_hour;


--
-- Name: timetable_work_start_minute_seq; Type: SEQUENCE; Schema: happyland; Owner: postgres
--

CREATE SEQUENCE happyland.timetable_work_start_minute_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE happyland.timetable_work_start_minute_seq OWNER TO postgres;

--
-- Name: timetable_work_start_minute_seq; Type: SEQUENCE OWNED BY; Schema: happyland; Owner: postgres
--

ALTER SEQUENCE happyland.timetable_work_start_minute_seq OWNED BY happyland.timetable_work.start_minute;


--
-- Name: employee idemployee; Type: DEFAULT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.employee ALTER COLUMN idemployee SET DEFAULT nextval('happyland.personal_idpersonal_seq'::regclass);


--
-- Name: manager idmanager; Type: DEFAULT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.manager ALTER COLUMN idmanager SET DEFAULT nextval('happyland.manager_idmanager_seq'::regclass);


--
-- Name: timetable_employee idtimetable_employee; Type: DEFAULT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_employee ALTER COLUMN idtimetable_employee SET DEFAULT nextval('happyland.tabletime_employee_idtabletime_employee_seq'::regclass);


--
-- Name: timetable_weekly idtimetable_weekly; Type: DEFAULT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_weekly ALTER COLUMN idtimetable_weekly SET DEFAULT nextval('happyland.timetable_weekly_idtimetable_weekly_seq'::regclass);


--
-- Name: timetable_work idtimetable_work; Type: DEFAULT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_work ALTER COLUMN idtimetable_work SET DEFAULT nextval('happyland.timetable_work_idtimetable_work_seq'::regclass);


--
-- Data for Name: employee; Type: TABLE DATA; Schema: happyland; Owner: postgres
--

COPY happyland.employee (idemployee, paternal, maternal, names, login, pass, weekly_hours, extra_hours, extra_minutes, gender, dni, mobile) FROM stdin;
31	Duis aute 	laborum.Lo	nisi ut aliquip	aboru	nisi 	28460	27838	7374	M	46846848	841684864
32	sunt in cu	ex ea comm	in reprehenderi	Ut en	nostr	30028	12957	8819	F	68468468	888168867
33	dolor sit 	sed do eiu	dolor sit amet,	sint 	eu fu	22197	25490	12222	M	46848646	464646464
34	sed do eiu	Ut enim ad	velit esse cill	adipi	qui o	12488	8227	17515	F	46848646	646464684
35	exercitati	exercitati	sint occaecat c	ad mi	in re	20551	10310	1499	M	68468468	646468864
36	sunt in cu	ut aliquip	velit esse cill	non p	sunt 	15437	10418	16074	F	13665468	464688646
37	cupidatat 	laborum.Lo	quis nostrud ex	Excep	ut al	6334	28571	26318	M	16816818	816886787
38	labore et 	Ut enim ad	ea commodo cons	Ut en	magna	9291	16987	5665	F	68468468	464684684
39	deserunt m	Duis aute 	in voluptate ve	molli	sit a	13645	1822	14367	F	84684684	168867879
40	anim id es	consectetu	nulla pariatur.	et do	ut al	24329	26195	18188	M	41866818	646886468
41	Excepteur 	cillum dol	minim veniam, q	exerc	exerc	15695	3656	19646	M	84186681	681464646
1	consectetu	esse cillu	cillum dolore e	tempo	sunt 	3112	16280	13045	F	84646861	464646468
2	id est lab	consectetu	sit amet, conse	Ut en	in cu	13927	21313	15317	M	36654684	468416848
3	aliquip ex	sunt in cu	pariatur. Excep	in re	ea co	26381	15699	242	F	64416824	464646464
4	ut aliquip	ad minim v	in voluptate ve	cupid	tempo	28399	6537	28938	M	68468468	997979796
5	commodo co	in culpa q	rum.Lorem ipsum	dolor	labor	7047	27689	31073	M	46861846	684684684
6	eiusmod te	et dolore 	dolor in repreh	do ei	ipsum	13852	19005	25602	M	61681681	886787997
7	tempor inc	sint occae	mollit anim id 	ut la	um.Lo	19961	28045	21505	M	68486468	646814646
8	tempor inc	ut labore 	pariatur. Excep	ullam	tempo	14589	26989	3035	M	86681861	646468468
9	aliqua. Ut	qui offici	labore et dolor	sint 	in vo	31967	26606	4790	M	86468468	648188816
10	ex ea comm	quis nostr	voluptate velit	incid	ut al	12941	18698	9570	M	64416824	646464646
11	proident, 	in volupta	Excepteur sint 	dolor	elit,	8732	25445	12214	M	48779874	646464646
12	nisi ut al	in reprehe	ut labore et do	cillu	ullam	7057	17202	5631	F	16841866	468864686
13	cillum dol	irure dolo	dolor sit amet,	sunt 	sint 	8693	20817	11907	M	84864684	684864684
14	dolor sit 	sed do eiu	ad minim veniam	in vo	elit,	16839	6694	21392	F	46846846	646886468
15	consequat.	dolore mag	est laborum.Lor	labor	Duis 	20107	17400	28431	M	98743136	799797979
16	veniam, qu	quis nostr	consectetur adi	sed d	in re	9255	20099	28670	M	18616816	676434646
17	dolor in r	ut labore 	et dolore magna	adipi	labor	6835	12610	9728	M	84684684	468864686
18	magna aliq	nostrud ex	sit amet, conse	orum.	repre	16939	14325	23202	F	68346846	818881688
19	ullamco la	laboris ni	mollit anim id 	ut la	nisi 	7295	12745	24696	F	64684136	979797967
20	sunt in cu	sint occae	esse cillum dol	esse 	nisi 	30736	18371	4764	F	84684684	146464646
21	aliqua. Ut	magna aliq	in voluptate ve	sit a	irure	25427	25239	8170	F	46861486	646468864
22	velit esse	sit amet, 	tempor incididu	m.Lor	deser	11324	15935	22594	M	46846846	967643464
23	occaecat c	qui offici	ut labore et do	Excep	sunt 	13050	6836	9047	M	84684684	979797967
24	esse cillu	dolor in r	cillum dolore e	elit,	quis 	16374	23153	29671	M	81861681	468416848
25	sunt in cu	ut labore 	veniam, quis no	dolor	anim 	13142	18619	13811	F	68486468	646464646
26	voluptate 	deserunt m	adipiscing elit	in vo	elit,	1058	30957	30096	F	68465468	686481888
27	in volupta	officia de	ullamco laboris	labor	elit,	10296	30152	18560	F	68186468	764346464
28	mollit ani	Excepteur 	ullamco laboris	sunt 	conse	32141	29708	30502	M	64841644	867879979
29	consequat.	borum.Lore	et dolore magna	volup	do ei	12632	25367	28087	F	68186168	864686481
30	sed do eiu	consequat.	exercitation ul	tempo	cupid	5229	2949	11102	M	48779874	848646814
42	do eiusmod	nisi ut al	dolor sit amet,	conse	exerc	4181	22649	25124	M	46846846	684684684
43	ex ea comm	eu fugiat 	irure dolor in 	in re	nisi 	29923	21234	24129	M	46846846	464646468
44	laboris ni	veniam, qu	deserunt mollit	ut la	aute 	1818	12197	9757	M	61486484	684684684
45	eu fugiat 	Ut enim ad	occaecat cupida	Excep	ad mi	27913	15102	6686	F	41866818	481888168
46	ipsum dolo	incididunt	dolor sit amet,	volup	conse	30559	4294	31449	M	68618464	468146464
47	velit esse	magna aliq	mollit anim id 	Duis 	quis 	6398	19807	13519	M	46846848	886468648
48	fugiat nul	Duis aute 	occaecat cupida	molli	culpa	20796	8864	20292	M	68468486	468648188
49	in culpa q	Duis aute 	veniam, quis no	dolor	molli	19186	20495	13273	M	54684684	168486468
50	anim id es	non proide	in culpa qui of	conse	in re	25299	20992	4361	F	46848646	979797967
51	ut labore 	commodo co	um.Lorem ipsum	eiusm	sint 	6290	29830	677	M	66546846	797967643
52	Excepteur 	quis nostr	ad minim veniam	ullam	ex ea	21516	30143	30703	M	84864684	864818881
53	in culpa q	occaecat c	cupidatat non p	anim 	repre	15284	15232	29480	M	46468614	646464646
54	ullamco la	elit, sed 	et dolore magna	velit	amet,	22909	30501	13846	M	61486484	979796764
55	ullamco la	ullamco la	Ut enim ad mini	dolor	cillu	12801	32592	27230	F	84684684	848646848
56	tempor inc	sint occae	sint occaecat c	qui o	commo	21485	22901	13948	M	54684684	646886468
57	in volupta	quis nostr	ex ea commodo c	elit,	Ut en	20083	7099	19777	M	84684684	646464688
58	ullamco la	proident, 	ipsum dolor sit	sint 	esse 	6370	1100	12065	F	68468468	468146464
59	sed do eiu	veniam, qu	laboris nisi ut	anim 	anim 	29087	27356	32526	M	18616816	646464646
60	nulla pari	non proide	pariatur. Excep	anim 	dolor	4120	6774	1186	F	84186681	646468468
61	consectetu	adipiscing	dolor sit amet,	cupid	adipi	21998	12618	17125	M	68146861	997979796
62	dolore eu 	occaecat c	in culpa qui of	aute 	labor	18583	27000	17025	M	84186681	464646464
63	ut labore 	ipsum dolo	sit amet, conse	esse 	repre	27641	32554	4042	F	61681681	997979796
64	sit amet, 	adipiscing	qui officia des	adipi	deser	31793	7878	10403	F	84684684	979796764
65	exercitati	deserunt m	irure dolor in 	tempo	cillu	30496	11272	21736	F	68468468	646468864
66	sint occae	do eiusmod	officia deserun	molli	adipi	2847	27303	24896	F	68468468	684684168
67	Ut enim ad	sit amet, 	veniam, quis no	Duis 	ut al	27292	26979	14572	M	41682487	646468468
68	magna aliq	quis nostr	velit esse cill	labor	id es	31796	977	4291	M	68468468	864681464
69	sit amet, 	ad minim v	pariatur. Excep	id es	non p	32329	28866	32627	M	84646861	867879979
70	do eiusmod	consequat.	irure dolor in 	nulla	qui o	12650	25111	24029	F	84684684	188816886
71	eu fugiat 	ipsum dolo	consectetur adi	deser	sint 	7666	1250	17638	M	84684684	684168486
72	laboris ni	voluptate 	et dolore magna	quis 	paria	13729	55	16295	M	84684684	646464646
73	ut aliquip	incididunt	pariatur. Excep	in vo	magna	31957	27113	22295	F	41368138	979797967
74	in volupta	laboris ni	consectetur adi	magna	Excep	18611	20803	4977	F	46846846	846846841
75	adipiscing	ut labore 	Duis aute irure	proid	sunt 	8124	32253	955	F	46861486	979797967
84			Juan			0	0	0	M	65446465	
85			Pedro	cupid	adipi	0	12618	17125	M	64684688	
86			Rolf	dolor	labor	0	27689	31073	M	77777777	
87			Raul	sunt 	sint 	0	20817	11907	M	77777778	
\.


--
-- Data for Name: manager; Type: TABLE DATA; Schema: happyland; Owner: postgres
--

COPY happyland.manager (idmanager, paternal, maternal, names, login, pass) FROM stdin;
\.


--
-- Data for Name: timetable_employee; Type: TABLE DATA; Schema: happyland; Owner: postgres
--

COPY happyland.timetable_employee (idtimetable_employee, day, start_hour, start_minute, number_hours, number_minutes, idemployee) FROM stdin;
\.


--
-- Data for Name: timetable_weekly; Type: TABLE DATA; Schema: happyland; Owner: postgres
--

COPY happyland.timetable_weekly (idtimetable_weekly, description, date, estate, idmanager) FROM stdin;
\.


--
-- Data for Name: timetable_work; Type: TABLE DATA; Schema: happyland; Owner: postgres
--

COPY happyland.timetable_work (idtimetable_work, day, start_hour, start_minute, number_hours, number_minutes, idemployee, idtimetable_weekly) FROM stdin;
\.


--
-- Name: manager_idmanager_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.manager_idmanager_seq', 1, false);


--
-- Name: personal_horas_extras_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.personal_horas_extras_seq', 1, false);


--
-- Name: personal_horas_semanales_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.personal_horas_semanales_seq', 1, false);


--
-- Name: personal_idpersonal_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.personal_idpersonal_seq', 87, true);


--
-- Name: personal_min_extras_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.personal_min_extras_seq', 1, false);


--
-- Name: tabletime_employee_day_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.tabletime_employee_day_seq', 1, false);


--
-- Name: tabletime_employee_idemployee_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.tabletime_employee_idemployee_seq', 1, false);


--
-- Name: tabletime_employee_idtabletime_employee_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.tabletime_employee_idtabletime_employee_seq', 1, false);


--
-- Name: tabletime_employee_number_minutes_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.tabletime_employee_number_minutes_seq', 1, false);


--
-- Name: tabletime_employee_start_hour_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.tabletime_employee_start_hour_seq', 1, false);


--
-- Name: tabletime_employee_start_minute_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.tabletime_employee_start_minute_seq', 1, false);


--
-- Name: timetable_weekly_idmanager_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_weekly_idmanager_seq', 1, false);


--
-- Name: timetable_weekly_idtimetable_weekly_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_weekly_idtimetable_weekly_seq', 1, false);


--
-- Name: timetable_work_idtimetable_employee_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_idtimetable_employee_seq', 1, false);


--
-- Name: timetable_work_idtimetable_weekly_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_idtimetable_weekly_seq', 1, false);


--
-- Name: timetable_work_idtimetable_work_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_idtimetable_work_seq', 1, false);


--
-- Name: timetable_work_number_hours_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_number_hours_seq', 1, false);


--
-- Name: timetable_work_number_minutes_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_number_minutes_seq', 1, false);


--
-- Name: timetable_work_start_hour_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_start_hour_seq', 1, false);


--
-- Name: timetable_work_start_minute_seq; Type: SEQUENCE SET; Schema: happyland; Owner: postgres
--

SELECT pg_catalog.setval('happyland.timetable_work_start_minute_seq', 1, false);


--
-- Name: employee employee_pk; Type: CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.employee
    ADD CONSTRAINT employee_pk PRIMARY KEY (idemployee);


--
-- Name: manager manager_pk; Type: CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.manager
    ADD CONSTRAINT manager_pk PRIMARY KEY (idmanager);


--
-- Name: timetable_employee tabletime_employee_pk; Type: CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_employee
    ADD CONSTRAINT tabletime_employee_pk PRIMARY KEY (idtimetable_employee);


--
-- Name: timetable_weekly timetable_weekly_pk; Type: CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_weekly
    ADD CONSTRAINT timetable_weekly_pk PRIMARY KEY (idtimetable_weekly);


--
-- Name: timetable_work timetable_work_pk; Type: CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_work
    ADD CONSTRAINT timetable_work_pk PRIMARY KEY (idtimetable_work);


--
-- Name: timetable_employee timetable_employee_employee_fk; Type: FK CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_employee
    ADD CONSTRAINT timetable_employee_employee_fk FOREIGN KEY (idemployee) REFERENCES happyland.employee(idemployee);


--
-- Name: timetable_weekly timetable_weekly_manager_fk; Type: FK CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_weekly
    ADD CONSTRAINT timetable_weekly_manager_fk FOREIGN KEY (idmanager) REFERENCES happyland.manager(idmanager);


--
-- Name: timetable_work timetable_work_employee_fk; Type: FK CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_work
    ADD CONSTRAINT timetable_work_employee_fk FOREIGN KEY (idemployee) REFERENCES happyland.employee(idemployee);


--
-- Name: timetable_work timetable_work_timetable_weekly_fk; Type: FK CONSTRAINT; Schema: happyland; Owner: postgres
--

ALTER TABLE ONLY happyland.timetable_work
    ADD CONSTRAINT timetable_work_timetable_weekly_fk FOREIGN KEY (idtimetable_weekly) REFERENCES happyland.timetable_weekly(idtimetable_weekly);


--
-- PostgreSQL database dump complete
--

