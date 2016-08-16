--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: role; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE role AS ENUM (
    'admin',
    'user'
);


ALTER TYPE role OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ads; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ads (
    id integer NOT NULL,
    title character varying(50) NOT NULL,
    category integer DEFAULT 1 NOT NULL,
    short_description character varying(50) NOT NULL,
    description character varying(255) NOT NULL,
    image character varying(255),
    phone character varying(12) NOT NULL,
    author integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone
);


ALTER TABLE ads OWNER TO postgres;

--
-- Name: ads_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ads_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ads_id_seq OWNER TO postgres;

--
-- Name: ads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ads_id_seq OWNED BY ads.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE categories (
    id integer NOT NULL,
    name character varying(20)
);


ALTER TABLE categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categories_id_seq OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categories_id_seq OWNED BY categories.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    firstname character varying(20),
    lastname character varying(20),
    email character varying(50) NOT NULL,
    password character varying(128) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone,
    role role DEFAULT 'user'::role NOT NULL
);


ALTER TABLE users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ads ALTER COLUMN id SET DEFAULT nextval('ads_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categories ALTER COLUMN id SET DEFAULT nextval('categories_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: ads; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ads (id, title, category, short_description, description, image, phone, author, created_at, updated_at) FROM stdin;
7	111	1	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1470939482.jpeg	111111111111	0	2016-08-07 22:32:34.01132	\N
12	1111	1	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1470939523.jpeg	111111111111	12	2016-08-11 21:18:43.603026	\N
10	admin	1	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1471287053.jpeg	111111111111	0	2016-08-07 23:16:00.790507	\N
4	4	1	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1471287060.jpeg	111111111111	0	2016-08-07 18:01:05.730029	\N
13	title aapapaoaoaoaddd	1	Ad short description Ad short description Ad short	Ad description	/uploads/ads/adopting-a-cat_1471288082.jpg	380938297789	11	2016-08-15 22:08:02.436336	\N
14	new course psychology	1	Ad short description Ad short description	Ad description Ad short description Ad short description Ad short description	/uploads/ads/Infinite-corridor-bboard_1471369991.jpeg	380938297789	11	2016-08-16 20:53:11.293232	\N
15	New course psychology	1	Ad short description	Ad description	\N	380938297789	0	2016-08-16 21:34:26.06175	\N
16	New course psychology	1	Ad short description	Ad description	\N	380938297789	0	2016-08-16 21:41:58.051728	\N
17	new course psychology1	1	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1471372990.jpeg	380938297789	0	2016-08-16 21:43:10.441088	\N
19	new course psychology	2	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1471378846.jpeg	380938297789	14	2016-08-16 23:20:46.831189	\N
18	new course psychology	4	Ad short description	Ad description	/uploads/ads/Infinite-corridor-bboard_1471373572.jpeg	111111111111	14	2016-08-16 21:52:52.809433	\N
20	New course psychology	3	Ad short description	Ad description	/uploads/ads/adopting-a-cat_1471378920.jpg	111111111111	14	2016-08-16 23:22:00.619105	\N
\.


--
-- Name: ads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ads_id_seq', 20, true);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY categories (id, name) FROM stdin;
1	general
2	education
3	vacation
4	work
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categories_id_seq', 4, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, firstname, lastname, email, password, created_at, updated_at, role) FROM stdin;
1	pola	lola	ayosovskaya@gmail.com	74a49c698dbd3c12e36b0b287447d833f74f3937ff132ebff7054baa18623c35a705bb18b82e2ac0384b5127db97016e63609f712bc90e3506cfbea97599f46f	2016-08-06 23:40:07.977259	\N	user
2	pola	lola	ayosovskaya@gmail.com	74a49c698dbd3c12e36b0b287447d833f74f3937ff132ebff7054baa18623c35a705bb18b82e2ac0384b5127db97016e63609f712bc90e3506cfbea97599f46f	2016-08-06 23:43:36.414539	\N	user
3	pola	lola	ayosovskaya@gmail.com	74a49c698dbd3c12e36b0b287447d833f74f3937ff132ebff7054baa18623c35a705bb18b82e2ac0384b5127db97016e63609f712bc90e3506cfbea97599f46f	2016-08-06 23:46:13.180477	\N	user
4	pola	lola	ayosovskaya@gmail.com	33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e	2016-08-06 23:46:20.608319	\N	user
5	pola	lola	ayosovskaya@gmail.com	74a49c698dbd3c12e36b0b287447d833f74f3937ff132ebff7054baa18623c35a705bb18b82e2ac0384b5127db97016e63609f712bc90e3506cfbea97599f46f	2016-08-06 23:47:18.019344	\N	user
6	ann	bolein	aaa@aaa	74a49c698dbd3c12e36b0b287447d833f74f3937ff132ebff7054baa18623c35a705bb18b82e2ac0384b5127db97016e63609f712bc90e3506cfbea97599f46f	2016-08-06 23:48:39.91702	\N	user
7	pola111	lola111	ayosovskaya1@gmail.com	aa6a33187400007578e7ecfa7d8fcd5db5a4ffe0ccbc80ed0119c3d9fc24e80b3f3da7d0daf9d0c7827c69328a181e8f94cc5ef6a1525effbcafbb538cc04c3a	2016-08-06 23:49:26.359203	\N	user
8	pola	lola	ayosovskaya@gmail.com	62670d1e1eea06b6c975e12bc8a16131b278f6d7bcbe017b65f854c58476baba86c2082b259fd0c1310935b365dc40f609971b6810b065e528b0b60119e69f61	2016-08-07 10:23:40.914655	\N	user
9	pola	lola	ayosovskaya@gmail.com	fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe	2016-08-07 10:24:49.968125	\N	user
11	admin	admin	admin@admin.com	c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec	2016-08-07 21:03:57.717488	\N	admin
12	1	1	1	62670d1e1eea06b6c975e12bc8a16131b278f6d7bcbe017b65f854c58476baba86c2082b259fd0c1310935b365dc40f609971b6810b065e528b0b60119e69f61	2016-08-07 22:23:16.730039	\N	user
13	2	2	2	1f86c769b319d953ab017153897f602b2fac6b73b4e64bf942085bd03c414c203c9030d47f33b937c9a3e30ed3764cf60eecbfd4e2284b736302fa837f8751c4	2016-08-07 22:34:31.931785	\N	user
14	Tanya	osovskaya	ayosovskaya@gmail.com	9ef5d597161d2134211a4a8b6d2e934464fc6f19d81cc8c2f170da645252da257a89efcdc942919a3f2196b291aac7bb517bde187bc88bfeb40eb8dcc7044a7f	2016-08-16 21:25:03.742418	\N	user
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 14, true);


--
-- Name: ads_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ads
    ADD CONSTRAINT ads_pkey PRIMARY KEY (id);


--
-- Name: categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

