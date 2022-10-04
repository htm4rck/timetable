--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
--
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

SELECT pg_catalog.setval('happyland.personal_idpersonal_seq', 1, true);


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

