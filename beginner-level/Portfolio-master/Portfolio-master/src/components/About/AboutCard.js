import React from "react";
import Card from "react-bootstrap/Card";
import { ImPointRight } from "react-icons/im";

function AboutCard() {
  return (
    <Card className="quote-card-view">
      <Card.Body>
        <blockquote className="blockquote mb-0">
          <p style={{ textAlign: "justify" }}>
            Hi Everyone, I am <span className="purple">Vaishnavi Pachhapur  </span>
            from <span className="purple"> Bangalore, India.</span>
            <br />
            I am currently pursuing my MCA from PES University, Bangalore.
            <br />
            I have completed BCA from SDM Degree College(Autonomous), Ujire, D.K.
            <br />
            I'm a passionate about building user-friendly and interactive web experiences. 
            <br />
            Projects involving web applications that I have completed -
            <br/>
            1. JEEVAPARA: Developed a comprehensive e-commerce web application to support and empower women from Bengaluru's most vulnerable areas.
             <br />
            <br />
            2. BLOGSPHERE: Developed a mini version of a functional blogging website with a dynamic and user-friendlyinterface.
            <br/>
            <br />
            3. CAREER-CONNECT: Web application that assists aspiring job seekers in preparing for interviews by offering acomprehensive suite of resources and tools.
            <br/>
            <br/>
            Additionally, I completed an internship in Python and Web Development at Shadowfox.
            <br/>
            Apart from coding, some other activities that I love to do!
          </p>
          <ul>
            <li className="about-activity">
              <ImPointRight /> Painting
            </li>
            <li className="about-activity">
              <ImPointRight /> Reading Blogs
            </li>
            <li className="about-activity">
              <ImPointRight /> Travelling
            </li>
          </ul>

          {/* <p style={{ color: "rgb(155 126 172)" }}>
            "Strive to build things that make a difference!"{" "}
          </p>
          <footer className="blockquote-footer">Vaishnavi</footer> */}
        </blockquote>
      </Card.Body>
    </Card>
  );
}

export default AboutCard;
