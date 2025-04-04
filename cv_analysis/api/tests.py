from django.test import TestCase

# Create your tests here.
from rest_framework.test import APITestCase
from rest_framework import status
from django.urls import reverse

class RankEndpointTest(APITestCase):
    def setUp(self):
        self.url = reverse("api:rank")
        self.valid_payload = {
            "job_post": (
                "We are seeking a Senior Python Developer with expertise in Django to join our fast-growing team. "
                "The ideal candidate should have at least 5 years of experience in backend development, with a deep "
                "understanding of Django, PostgreSQL, RESTful API design, and cloud platforms like AWS or Azure. "
                "Experience with Docker, Kubernetes, and CI/CD pipelines is highly desirable. Candidates should also "
                "be comfortable working with JavaScript frameworks like React or Vue.js for frontend integration. "
                "Additional experience in machine learning, data engineering, or fintech applications will be a plus. "
                "Responsibilities include designing and maintaining scalable web applications, optimizing database queries, "
                "ensuring application security, and collaborating with frontend developers and DevOps engineers in an Agile environment."
            ),
            "applications": [
                # Highly Relevant - English
                {"user_id": "301", "application": (
                    "I have over 6 years of experience developing complex backend systems using Python and Django. "
                    "In my most recent role, I designed and maintained a microservices-based architecture, implemented RESTful APIs, "
                    "and optimized PostgreSQL queries for speed and performance. I’ve worked with Docker for containerization, set up CI/CD "
                    "pipelines using GitHub Actions, and managed cloud deployments on both AWS and Azure. Additionally, I collaborated with React "
                    "developers to ensure smooth frontend-backend integration and practiced strict security standards across applications. "
                    "I’m also experienced in Agile workflows, regularly participated in sprint planning and retrospectives, and contributed to mentoring junior developers."
                )},
                # Highly Relevant - Swahili
                {"user_id": "302", "application": (
                    "Nina uzoefu wa zaidi ya miaka 5 katika maendeleo ya programu kwa kutumia Python na Django. "
                    "Nimetengeneza API zenye ufanisi mkubwa na kutumia PostgreSQL kwa hifadhi ya data katika miradi mikubwa. "
                    "Nimefanya kazi na Docker kwa ajili ya kufunga mazingira ya programu na kutumia AWS kwa ajili ya ku-deploy programu. "
                    "Vilevile, nimeshirikiana na timu za React kuhakikisha mawasiliano bora kati ya frontend na backend. "
                    "Nimeendesha miradi kwa kutumia Agile na kuchangia sana katika mipango ya sprint, code reviews, na usalama wa programu."
                )},

                # Slightly Relevant - English
                {"user_id": "303", "application": (
                    "I'm a full-stack developer with a strong focus on frontend technologies like React and Vue.js. "
                    "While my backend experience is mostly with Node.js and Express, I have contributed to a Django-based open source project "
                    "where I wrote a few REST endpoints and fixed bugs in PostgreSQL queries. I'm familiar with AWS services like EC2 and S3, and "
                    "have set up CI/CD workflows using GitLab CI. I'm interested in expanding my Django expertise and transitioning to more Python-based backends. "
                    "I work well in Agile teams and have experience integrating frontend with various REST APIs."
                )},

                # Slightly Relevant - Swahili
                {"user_id": "304", "application": (
                    "Nimekuwa nikifanya kazi kama developer wa backend kwa kutumia Flask na PostgreSQL. "
                    "Sijatumia Django sana, lakini nimeisoma na nimeandika baadhi ya modules katika miradi midogo. "
                    "Nina uzoefu na CI/CD kupitia GitLab, na nimewahi ku-deploy miradi yangu kwenye AWS EC2. "
                    "Ninaelewa vizuri utengenezaji wa API na usalama wa programu. Nimefanya kazi na timu za Agile katika kampuni mbili tofauti, "
                    "na ninapenda kujifunza zaidi kuhusu Django na teknolojia za kifedha katika programu."
                )},

                # Irrelevant - English
                {"user_id": "305", "application": (
                    "As a digital marketing expert, my focus has been on SEO, paid advertising, and customer acquisition strategies. "
                    "I’ve worked with analytics platforms, content management systems, and social media tools. "
                    "Although I have collaborated with development teams to improve landing page performance and implemented A/B testing strategies, "
                    "I haven’t written code or worked with Python or Django. I’m now exploring how tech roles operate so I can better support product teams "
                    "from a marketing perspective. However, I currently don’t possess the technical qualifications described in this job post."
                )},

                # Irrelevant - Swahili
                {"user_id": "306", "application": (
                    "Mimi ni mtaalamu wa masoko ya mitandao ya kijamii. Nimekuwa nikitengeneza maudhui ya dijitali, "
                    "kusimamia akaunti za wateja, na kufanya uchambuzi wa soko kwa kutumia Google Analytics. "
                    "Sijawahi kufanya kazi ya programu wala sina ujuzi wa Python, Django, au maendeleo ya backend. "
                    "Ingawa napenda teknolojia, sina uzoefu katika kubuni au kutengeneza programu za wavuti."
                )},

                # Mixed Language - Highly Relevant
                {"user_id": "307", "application": (
                    "I have worked as a Django developer kwa zaidi ya miaka mitano. I built RESTful APIs, optimized PostgreSQL queries, "
                    "and deployed full systems on AWS using Docker. Pia nimekuwa nikifanya kazi na React kwa ajili ya frontend integration, "
                    "na kushirikiana na DevOps engineers kwenye CI/CD pipelines. I'm highly comfortable with Agile methodologies and mentoring junior engineers. "
                    "Kwa sasa, nimejikita kwenye fintech projects zinazotumia Django, Celery, na Redis."
                )},

                # Mixed Language - Slightly Relevant
                {"user_id": "308", "application": (
                    "Najua Python vizuri sana, and I’ve worked with Flask on multiple data-driven dashboards. "
                    "Django siijatumia sana, lakini nimesoma documentation na kuandika baadhi ya code kwenye side projects. "
                    "I’m familiar with PostgreSQL and RESTful APIs, and nimesetup Docker containers before for development environments. "
                    "Ningependa kujifunza zaidi kuhusu Django katika mazingira ya kweli ya kazi."
                )},

                # Mixed Language - Irrelevant
                {"user_id": "309", "application": (
                    "Nafanya kazi kama customer care specialist katika kampuni ya mawasiliano. I help clients solve issues via phone and email, "
                    "and I have zero experience in programming or software development. Nimewahi kuwasiliana na timu za IT kuhusu matatizo ya mifumo, "
                    "lakini sijawahi kuandika hata line moja ya code. Programming ni kitu ninachopenda kujifunza siku moja, lakini sio sasa hivi."
                )},

                # Highly Relevant - English
                {"user_id": "310", "application": (
                    "I’ve led backend teams working on Django-based platforms for fintech startups. I specialize in API architecture, ORM optimization, "
                    "and security audits. I’ve used Celery for background tasks, PostgreSQL for relational data, and deployed on AWS with Terraform and ECS. "
                    "My experience includes implementing CI/CD workflows, managing container orchestration with Kubernetes, and mentoring teams through Agile. "
                    "I’ve also done React integration and have experience writing end-to-end tests using Pytest and Postman. This role aligns well with my background."
                )},
            ]
        }


    def test_rank_endpoint_valid_request(self):
        response = self.client.post(self.url, self.valid_payload, format='json')
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertIn("results", response.data)
        self.assertIsInstance(response.data["results"], list)
        
        for item in response.data["results"]:
            self.assertIn("user_id", item)
            self.assertIn("score", item)
            self.assertIsInstance(item["user_id"], str)
            self.assertIsInstance(item["score"], (int, float))

    def test_rank_endpoint_missing_fields(self):
        invalid_payload = {"job_post": "Python developer needed."}  # Missing applications
        response = self.client.post(self.url, invalid_payload, format='json')
        self.assertEqual(response.status_code, status.HTTP_400_BAD_REQUEST)

    def test_rank_endpoint_invalid_format(self):
        invalid_payload = {"job_post": 123, "applications": "not a list"}  # Wrong data types
        response = self.client.post(self.url, invalid_payload, format='json')
        self.assertEqual(response.status_code, status.HTTP_400_BAD_REQUEST)
