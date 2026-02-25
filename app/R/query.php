
library(tidyverse)
library(dplyr)
library(rjson)
data<- read_csv('/filesbi/temp/04eb514a2e4714fc46b8e0b9e60c7687_7f9b9b018c9000302413112e47a147a2.csv')
 data<-filter(data,(`idestructura`== '152' | `idestructura`== '153' | `idestructura`== '154' | `idestructura`== '155' | `idestructura`== '156' | `idestructura`== '157' | `idestructura`== '158' | `idestructura`== '159' | `idestructura`== '212' | `idestructura`== '213' | `idestructura`== '217' | `idestructura`== '218' | `idestructura`== '219' | `idestructura`== '220' | `idestructura`== '221' | `idestructura`== '222') & (`425936X35X1155`== '52871482') & (`idAnswer`== '37866'))

rd<- group_by(data,`riesgom`,`modificadoProcam`)
rd<-summarise(rd,Total_datos = n())
 


rd<-arrange(rd, Total_datos)


x<- toJSON(rd)
cat(x)
