d [0-9]
l [a-zA-Z]
%%
{l}({l}|{d})*	 { printf("%s:\tSI\n",yytext); }
\n					 ;					 
.+   	                       		 { printf("%s:\tNO\n",yytext); }
%%

