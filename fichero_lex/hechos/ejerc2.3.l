interior ([^\*]*(\**[^\*\)]+)?)*
%%
\(\*{interior}\*+\)	 { printf("%s:\tSI\n",yytext); }
\n					 ;					 
.+   	                       		 { printf("%s:\tNO\n",yytext); }
%%

