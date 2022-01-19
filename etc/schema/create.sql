SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: bikes; Type: TABLE; Schema: public; Owner: rentabike
--

CREATE TABLE public.bikes (
                              bike_id character varying(36) NOT NULL,
                              bike_type character varying(255) NOT NULL,
                              bike_name character varying(255) NOT NULL
);


ALTER TABLE public.bikes OWNER TO rentabike;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: rentabike
--

CREATE TABLE public.doctrine_migration_versions (
                                                    version character varying(191) NOT NULL,
                                                    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
                                                    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO rentabike;

--
-- Data for Name: bikes; Type: TABLE DATA; Schema: public; Owner: rentabike
--

COPY public.bikes (bike_id, bike_type, bike_name) FROM stdin;
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: rentabike
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
Kishlin\\Migrations\\Version20220118175435	2022-01-19 10:00:47	12
\.


--
-- Name: bikes bikes_pkey; Type: CONSTRAINT; Schema: public; Owner: rentabike
--

ALTER TABLE ONLY public.bikes
    ADD CONSTRAINT bikes_pkey PRIMARY KEY (bike_id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: rentabike
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- PostgreSQL database dump complete
--

