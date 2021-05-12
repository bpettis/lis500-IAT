# lis500-IAT - Alternative Implicit Bias Test

## About this Repository:
This is a backup of the live version of the test, which previously existed at [http://group8.raroyston.org/](http://group8.raroyston.org/). Each time the course is taught, previous semesters' work is removed from the class web server. Thus, I have uploaded copies of the website's directory structure, as well as a backup of the database structure

### Team Members
- Ben Pettis
- Rena Liu
- Jacob Schilling
- Yiheng Wei

### Included Files:
- group8results.sql - recreate the results table for the project. Does not contain any data/survey results
- web-root (directory) - contains all of the files for the website

### System Requirements:
In theory, this website should work on any webserver with the LAMP or WAMP stack - it uses PHP and mySQL to function. 

The website was previously hosted on [Bluehost](https://www.bluehost.com/). It was running the following software and versions:

- PHP version: 7.3.27
- Database client version: libmysql - 5.6.43
- PHP extensions: mysqli, curl, mbstring
- phpMyAdmin: version 4.9.5


## Assignment Brief:

In this assignment, you will work in groups of 4 people to design and implement your own, from scratch, brand new... alternative to the [Harvard Implicit Bias Test](https://implicit.harvard.edu/implicit/). Choose a set of parameters to test (e.g. race, gender, class, ability, citizenship, or combination of these.) Think of this NOT as a scientific survey, more a test or workshop exercise, inline with the kinds of community education that Detroit's Our Data Our Bodies does.  

This assignment will build upon Assignment 4, and what you've learned in this course overall. Unlike the Shared Survey, where the results page just showed the test-taker's results, your Final Code results page should compare the results of everyone who has taken the test May 2  version (see dates below).

You will also need to create a new database table for your group's survey to use in PHPMyAdmin. Show the results, and help the test-taker contextualize where their data puts them in comparison to everyone, according to your scheme. In other words, what should they learn after having gone through your forms, and taken a 'test' for bias.

## Introduction
This is an alternative Implicit Bias Test created as part of the Code and Power course (LIS500) in the University of Wisconsin-Madison's [iSchool](https://ischool.wisc.edu). Here you will take a 10-minute test where you learn about biases towards race and/or gender regarding crime. The test requires the ability to identify people through photos and describe them as innocent or guilty in relation to crime.

Our Implicit Bias Test about Crime aims to test each individual’s biases towards race and gender through a series of questions along with a summary of results. Each question is directed at the individual’s thought process, thus giving them a score determining how biased they are towards each photo in relation to crime. Safiya Noble (2018) has argued that even in cases where people are attempting to seek accurate information, search engines can nevertheless feed their confirmation biases. Using examples of search queries such as “black on white” crimes and “black on black crimes,” Noble demonstrates that crime can be a significant topic for the exploration of implicit biases.

We hope to gain people’s attention in how they are judging and assuming a stranger’s background from their physical appearance. We recognize there may be some limitations in our test as there is no exact “right” answer; however, it allows each individual to compare their answers with the public and to reflect on their own choices. Ultimately, the test gathers information on one’s implicit racial and gender biases within crime by using timed elements and numerical responses.


## Description of the Test
We came up with 5 questions about the person’s personality and characteristics to indirectly see if they may be possibly related to criminal behavior or crime. There have been multiple studies out there regarding personality and criminal behavior such as mental factors. Therefore, having the user answer these questions before the photos help determine if they are familiar with our topic. Moreover, making it multiple choice from a range of 1 (strongly disagree) to 5 (strongly agree) allows us to collect overall data to see what the average answer is for the community and to compare answers.

In this part of the test, we also ask users to write a brief 25-word description of themselves. While there is a word counter under the text field, we do not specifically check or validate the number of words that were actually written. The purpose of this question is twofold. First, we want to prepare the user for the type of written input that the rest of the test will ask them to complete. Second, it provides a baseline to compare the written descriptions for the second part of the test. While we compare individual Likert responses to all of the test responses, for the written portions we only compare a user’s results to their responses for other questions.

In the second part of the test, users are asked to indicate whether they believe the person is innocent or guilty from a series of photos. They are also asked to indicate on a Likert scale the extent to which they think the person in the photo looks similar to them. Keeping the inherent intersectionality of identities in mind, we aim to avoid leading the user to compare themselves in a particular way (such as gender, race, age, etc.) and instead leave this comparison purposefully vague and open-ended.

Finally, the user is provided with a text box and is asked to briefly explain their reasoning for their decision. Each photo is someone who may have been convicted of a crime or accused of one but later found to be innocent. Although there are only six photos, we tried to include a wide range of age groups, gender identity, and ethnic backgrounds. The purpose of the test is to raise general awareness of implicit biases broadly, and not necessarily the biases that are associated with a particular group, as is the case with the Harvard IAT.

We wanted there to be a balance among the photos of who is innocent and guilty as a way to minimize bias within the test itself. Ideally, the test-taker would be making assessments of a person they had never seen before as a way to encourage self-reflection on their own internal biases. However, this is not always possible given that we selected our photos based on publicly available images, and that it is not possible to design a test to account for everyone’s possible background knowledge. Thus, our instructions direct the user to indicate if they did recognize the person as part of their description.

The design of our test website is simple, especially when compared to the flashy and dynamic pages that typify the Web 2.0 aesthetic. While we do use CSS and HTML header tags to organize the page content and maintain typographic hierarchy, we do not use many colors, animations, or other dynamic elements beyond the word counter. As Sean Cubitt (1998) has written, a computer interface can implicitly signal who a particular technology is for (and conversely, who it is not for). By designing our website with simple and straightforward techniques, we aim to make our test viewable on a wide range of devices and, by extension, accessible to as many people as possible.

### Measures and Analysis
There are several variables that we are measuring in this survey, each of which provides the user with varying insight and opportunities to reflect on their own implicit biases. While we do provide some comparisons to others who have taken the test, we attempt to do so in a way to facilitates self-reflection and self-awareness. Noble (2018) reminds us that neoliberalism is the dominant framework of contemporary social and economic policies, and that under this ideology, “individuals make choices of their own accord in the free market, which is normalized as the only legitimate source of social change” (p. 166). A “results” page is necessarily directed toward the individual and thus unfortunately follows some neoliberal logics. To avoid our test being framed as a scientifically-backed diagnostic test, we felt it was important to include extensive written explanations of our measures as well as include open-ended questions to promote self-reflection by the user.

First, we provide a “score” which counts the number of correct responses when assessing whether the person in each photo was guilty or innocent. The purpose of this is to offer the user at least some concrete grounding to contextualize their responses. Conversely, if a person believed they were somehow assessing the person in the photos effectively, a low score might encourage them to rethink their accuracy. Admittedly, including a “score” at the end of the survey is potentially problematic in that it implies that they may be a correct or preferred way to take the survey, and furthermore runs the risk of gamifying what is meant to be a serious consideration of implicit bias.

Second, we compare the user’s self-assessment scores with the averages of everyone who completed that portion of the survey. While this is less directly about demonstrating implicit biases, it nevertheless prompts the user to do some self-reflection on how they see themselves in comparison to other people. This provides some background context to the written descriptions that comprise other portions of the test.

For each photo, we display the user’s numerical similarity score alongside averages of how all respondents rated their perceived similarity. This variable represents the many ways that people may see themselves in relation to other people. The comparison being made here is purposely vague; we do not specify what we mean by “similarity.” Instead, we leave this for the user to interpret for themselves.

Finally, we provide an approximate measurement of the time that the user took to complete the written description under each photo. In the test, we are not actually doing anything with the specific content of the user response. Instead, we are interested in how long it takes the user to explain their reasoning for each photo, along with how this compares to their own self-description time. We believe that this may be a potential way to indirectly measure how people evaluate other individuals, and thus may be a productive method for promoting awareness of implicit biases.
